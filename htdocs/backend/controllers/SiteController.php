<?php
namespace backend\controllers;

use backend\helpers\MainHelper;
use backend\models\AuthAssignment;
use backend\models\Feature;
use backend\models\FeatureSearch;
use backend\models\ManagerUser;
use backend\models\PasswordResetRequestForm;
use backend\models\PromoAdmin;
use backend\models\ResetPasswordForm;
use backend\models\UserCall;
use backend\models\UserCallAudio;
use common\models\ClientCalls;
use common\models\Statuses;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'auth', 'error', 'request-password-reset', 'reset-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'date-call', 'delete-call', 'upload-audio'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'delete-call'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $currentDate = date('Y-m-d');
        $currentUserId = Yii::$app->user->identity->getId();

        $role = AuthAssignment::findOne(['user_id' => Yii::$app->user->identity->id]);

        if ($role && $role->item_name == 'Администратор') {
            $calls = ClientCalls::find()
                ->joinWith(['client'])
                ->andWhere(['<=', 'DATE(date)', $currentDate])
                ->andWhere(['client_calls.status' => 0])
                ->orderBy('time')
                ->all();

            $futureCalls = ClientCalls::find()
                ->joinWith(['client'])
                ->andWhere(['>', 'DATE(date)', $currentDate])
                ->andWhere(['client_calls.status' => 0])
                ->orderBy(['date' => SORT_ASC, 'time' => SORT_ASC])
                ->all();
        } else {
            $calls = ClientCalls::find()
                ->joinWith(['client'])
                ->where(['clients.user_id' => $currentUserId])
                ->andWhere(['<=', 'DATE(date)', $currentDate])
                ->andWhere(['client_calls.status' => 0])
                ->orderBy('time')
                ->all();

            $futureCalls = ClientCalls::find()
                ->joinWith(['client'])
                ->where(['clients.user_id' => $currentUserId])
                ->andWhere(['>', 'DATE(date)', $currentDate])
                ->andWhere(['client_calls.status' => 0])
                ->orderBy(['date' => SORT_ASC, 'time' => SORT_ASC])
                ->all();
        }

        return $this->render('index', [
            'calls' => $calls,
            'futureCalls' => $futureCalls
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = User::findByEmail($model->email);

            if ($user && $user->is_user == 0 && $user->qr_status == Statuses::STATUS_HIDDEN && $model->login()) {
                return $this->goBack();
            }

            if ($user && $user->is_user == 0 && $user->status == Statuses::USER_ACTIVE && $user->validatePassword($model->password)) {
                if (!isset(Yii::$app->request->cookies['login-user'])) {
                    Yii::$app->response->cookies->add(new \yii\web\Cookie([
                        'name' => 'login-user',
                        'value' => $user
                    ]));
                }

                return $this->redirect('auth');
            } else {
                Yii::$app->session->setFlash('danger', 'Не верный email или пароль!');
                $model->password = '';

                return $this->refresh();
            }
        } else {

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    public function actionAuth()
    {
        $this->layout = 'main-login';

        if (!Yii::$app->user->isGuest || !isset(Yii::$app->request->cookies['login-user'])) {
            return $this->goHome();
        }

        $user = Yii::$app->request->cookies->getValue('login-user');

        $g = new \Google\Authenticator\GoogleAuthenticator();

        $secret = $user->secret_key;

        if ($code = Yii::$app->request->post('code')) {
            if ($g->checkCode($secret, $code) && Yii::$app->user->login($user)) {
                Yii::$app->response->cookies->remove('login-user');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('danger', 'Не верный код!');

                return $this->refresh();
            }
        }

        return $this->render('auth', [
            'g' => $g,
            'secret' => $secret
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $this->layout = 'main-login';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте ваш email и следуйте дальнейшим инструкциям.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Email не найден.');
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        $this->layout = 'main-login';
        try {
            $user = User::findByPasswordResetToken($token);
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль успешно сохранен.');
            return $this->redirect('login');
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

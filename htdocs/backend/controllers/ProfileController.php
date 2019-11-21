<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Profile;
use yii\web\Response;
use yii\widgets\ActiveForm;
use backend\models\ChangePassword;
use common\models\User;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        return $this->Common();
    }

    public function actionQrCode()
    {
        Yii::$app->controller->enableCsrfValidation = false;

        if (Yii::$app->request->isAjax) {
            $user = User::findOne(Yii::$app->user->identity->getId());
            $user->qr_status = 1;

            if ($user->save(false)) {
                $g = new \Google\Authenticator\GoogleAuthenticator();
                $explode = explode('@', $user->email);

                return json_encode([
                    'success' => true,
                    'data' => [
                        'secret' => $user->secret_key,
                        'img' => '<img src="'.$g->getURL($explode[0], $explode[1], $user->secret_key).'" style="display: block; margin: 0 auto;" />'
                    ]
                ]);
            }

            return json_encode(['success' => false]);
        }
        return json_encode(['success' => false]);
    }

    public function actionQrCodeDisable()
    {
        if (Yii::$app->request->post('code')) {
            $user = User::findOne(Yii::$app->user->identity->getId());

            $g = new \Google\Authenticator\GoogleAuthenticator();

            $secret = $user->secret_key;

            if ($g->checkCode($secret, Yii::$app->request->post('code'))) {
                $user->qr_status = 0;
                $user->save();
                Yii::$app->session->setFlash('info', 'Двойная авторизация отключена!');
            } else {
                Yii::$app->session->setFlash('danger', 'Не верный код!');
            }

            return $this->redirect('index');
        }
    }

    public function actionChangePassword()
    {
        $model = new ChangePassword();
        $user = User::findOne([Yii::$app->user->identity->getId()]);

        if (!Yii::$app->request->isPjax && Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->newPassword);

                if ($user->save(false)) {
                    Yii::$app->session->setFlash('success', 'Вы успешно поменяли пароль!');
                } else {
                    Yii::$app->session->setFlash('danger', 'Ошибка! Не удалось поменять пароль!');
                }

                return $this->Common();
            }
        }
    }

    protected function Common()
    {
        $pass = new ChangePassword();
        $user = Yii::$app->user->identity;
        $model = Profile::findOne(['id' => $user->getId()]);

        $request = Yii::$app->request->isPjax ? 'renderAjax' : 'render';

        if (Yii::$app->request->isPjax && $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Данные успешно обновлены!');

            return $this->renderAjax('index', [
                'user' => $user,
                'model' => $model,
                'pass' => $pass
            ]);
        }

        return $this->$request('index', [
            'user' => $user,
            'model' => $model,
            'pass' => $pass
        ]);
    }

}

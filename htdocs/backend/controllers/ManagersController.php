<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\AuthAssignment;
use backend\models\ManagersSearch;
use backend\models\Staff;
use common\models\Statuses;
use common\models\User;

class ManagersController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ManagersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Staff();

        if ($model->load(Yii::$app->request->post()) && $model->registerStaff(Yii::$app->request->post('Staff'))) {
            Yii::$app->session->setFlash('success', 'Пользователь успешно зарегистрирован!');

            return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Staff::findOne($id);
        $auth = AuthAssignment::findOne(['user_id' => $model->id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $post = Yii::$app->request->post('Staff');
            $auth->item_name = $post['role'];

            if ($auth->save()) {
                Yii::$app->session->setFlash('info', 'Данные успешно изменены!');

                return $this->redirect('index');
            }
        }

        return $this->render('update', [
            'auth' => $auth,
            'model' => $model
        ]);
    }

    public function actionQrReset($id)
    {
        $user = User::findOne($id);

        if ($user) {
            $user->qr_status = Statuses::STATUS_HIDDEN;
            $user->save();

            Yii::$app->session->setFlash('warning', 'QR код успешно сброшен!');

            return $this->redirect('index');
        }
    }

    public function actionActivate($id)
    {
        $user = User::findOne($id);

        if ($user) {
            $user->status = Statuses::USER_ACTIVE;
            $user->save();

            Yii::$app->session->setFlash('warning', 'Пользователь возобновлен!');

            return $this->redirect('index');
        }
    }

    public function actionDelete($id)
    {
        $user = User::findOne($id);

        if ($user) {
            $user->status = Statuses::USER_DELETED;
            $user->save();

            Yii::$app->session->setFlash('warning', 'Пользователь удален!');

            return $this->redirect('index');
        }
    }
}

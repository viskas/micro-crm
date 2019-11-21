<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use backend\models\Personal;
use backend\models\SearchPersonal;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;


class PersonalController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new SearchPersonal();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Personal();

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Добавить нового пользователя",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->validate() && $model->registerStaff($request->post('Personal'))){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Добавить нового пользователя",
                    'content'=>'<span class="text-success">Пользователь успешно создан</span>',
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::a('Добавить еще',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "Добавить нового пользователя",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }
        }else{
            if ($model->load($request->post()) && $model->registerStaff($request->post('Personal'))) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Пользователь ID: ".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::a('Сменить пароль',['change-password', 'id' => $id],['class'=>'btn btn-warning','role'=>'modal-remote']).
                        Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                Yii::$app->session->setFlash('success', 'Сохранено!');
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'forceClose'=>true,
                ];
            }else{
                return [
                    'title'=> "Пользователь ID: ".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::a('Сменить пароль',['change-password', 'id' => $id],['class'=>'btn btn-warning','role'=>'modal-remote']).
                        Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }else{
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionChangePassword($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Смена пароля пользователя ID:".$id,
                    'content'=>$this->renderAjax('change-password', [
                        'model' => $model
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if(Yii::$app->request->post('new-password')){
                $model->password_hash = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('new-password'));
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Новый пароль сохранен!');
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'forceClose'=>true,
                    ];
                }
            }else{
                return [
                    'title'=> "Смена пароля пользователя ID:".$id,
                    'content'=>$this->renderAjax('change-password', [
                        'model' => $model
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }
    }

    public function actionResetQr($id)
    {
        $model = $this->findModel($id);

        $model->qr_status = 0;
        if($model->save(false))
            Yii::$app->session->setFlash('info', 'QR код успешно убран!');

        if(Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        } else {
            return $this->redirect(['index']);
        }
    }

    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        $model->status = ($model->status == User::STATUS_DELETED ? User::STATUS_ACTIVE : User::STATUS_DELETED);

        if ($id != Yii::$app->user->identity->getId() && $model->save(false)) {
            Yii::$app->session->setFlash('success', 'Сохранено');
        } else {
            Yii::$app->session->setFlash('error', 'Вы не можете заблокировать самого себя!');
        }

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            return $this->redirect(['index']);
        }
    }

    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' ));
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->status = ($model->status == User::STATUS_DELETED ? User::STATUS_ACTIVE : User::STATUS_DELETED);

            if ($pk == Yii::$app->user->identity->getId() || !$model->save(false)) {
                Yii::$app->session->setFlash('error', 'Вы не можете заблокировать самого себя!');
            } else {
                Yii::$app->session->setFlash('success', 'Сохранено');
            }
        }

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            return $this->redirect(['index']);
        }

    }

    protected function findModel($id)
    {
        if (($model = Personal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

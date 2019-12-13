<?php

namespace backend\controllers;

use common\models\ClientCalls;
use common\models\ClientComments;
use common\models\User;
use Yii;
use common\models\Clients;
use backend\models\AdminClientsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;


class AdminClientController extends Controller
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
        $searchModel = new AdminClientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $users = Clients::find()
            ->select(['user_id', 'user.first_name'])
            ->joinWith(['user'])
            ->distinct()
            ->all();
        $users = ArrayHelper::map($users, 'user_id', 'user.first_name');

        $systems = Clients::find()
            ->select(['platform'])
            ->distinct()
            ->all();
        $systems = ArrayHelper::map($systems, 'platform', 'platform');

        $statuses = Clients::find()
            ->select(['status'])
            ->distinct()
            ->all();
        $statuses = ArrayHelper::map($statuses, 'status', 'status');

        $filters = Clients::find()
            ->select(['filter'])
            ->distinct()
            ->all();
        $filters = ArrayHelper::map($filters, 'filter', 'filter');

        return $this->render('index', [
            'users' => $users,
            'systems' => $systems,
            'filters' => $filters,
            'statuses' => $statuses,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $calls = ClientCalls::find()
            ->joinWith(['client'])
            ->where(['client_id' => $id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        $comments = ClientComments::find()
            ->joinWith(['client'])
            ->where(['client_id' => $id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'calls' => $calls,
            'comments' => $comments,
        ]);
    }

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        $users = User::find()
            ->select(['id', 'first_name'])
            ->where(['status' => User::STATUS_ACTIVE])
            ->all();
        $users = ArrayHelper::map($users, 'id', 'first_name');

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Редактирование ID: ".$id,
                    'content'=>$this->renderAjax('update', [
                        'users' => $users,
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                Yii::$app->session->setFlash('success', 'Сохранено');

                return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            }else{
                return [
                    'title'=> "Редактирование ID: ".$id,
                    'content'=>$this->renderAjax('update', [
                        'users' => $users,
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
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

    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Клиент удален');
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
        if (($model = Clients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

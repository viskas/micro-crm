<?php

namespace backend\controllers;

use common\models\ClientCalls;
use common\models\ClientComments;
use Yii;
use common\models\Clients;
use backend\models\ClientsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;


class ClientController extends Controller
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
        $searchModel = new ClientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $systems = Clients::find()
            ->select(['platform'])
            ->where(['user_id' => Yii::$app->user->identity->getId()])
            ->distinct()
            ->all();
        $systems = ArrayHelper::map($systems, 'platform', 'platform');

        $statuses = Clients::find()
            ->select(['status'])
            ->where(['user_id' => Yii::$app->user->identity->getId()])
            ->distinct()
            ->all();
        $statuses = ArrayHelper::map($statuses, 'status', 'status');

        return $this->render('index', [
            'systems' => $systems,
            'statuses' => $statuses,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $callModel = new ClientCalls();
        $commentModel = new ClientComments();

        $request = Yii::$app->request;

        $callModel->client_id = $id;
        $commentModel->client_id = $id;

        if ($callModel->load($request->post()) && $callModel->save()) {
            Yii::$app->session->setFlash('success', 'Перезвон добавлен');

            return $this->refresh();
        }

        if ($commentModel->load($request->post()) && $commentModel->save()) {
            Yii::$app->session->setFlash('success', 'Комментарий добавлен');

            return $this->refresh();
        }

        $userId = Yii::$app->user->identity->getId();

        $calls = ClientCalls::find()
            ->joinWith(['client'])
            ->where(['client_id' => $id])
            ->andWhere(['clients.user_id' => $userId])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        $comments = ClientComments::find()
            ->joinWith(['client'])
            ->where(['client_id' => $id])
            ->andWhere(['clients.user_id' => $userId])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('view', [
            'id' => $id,
            'model' => $this->findModel($id),
            'calls' => $calls,
            'comments' => $comments,
            'callModel' => $callModel,
            'commentModel' => $commentModel
        ]);
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Clients();  

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Добавление клиента",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->validate()){
                $model->user_id = Yii::$app->user->identity->getId();
                $model->created_at = date('Y-m-d H:i:s');
                $model->save();

                Yii::$app->session->setFlash('success', 'Клиент добавлен');

                return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            }else{           
                return [
                    'title'=> "Добавление клиента",
                    'content'=>$this->renderAjax('create', [
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
                    'title'=> "Редактирование ID: ".$id,
                    'content'=>$this->renderAjax('update', [
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

    public function actionCallStatus()
    {
        $request = Yii::$app->request;

        if ($request->post() && $id = $request->post('id')) {
            $clientCall = ClientCalls::findOne($id);

            $clientCall->status = $clientCall->status == 0 ? 1 : 0;

            if ($clientCall->save(false)) {
                Yii::$app->session->setFlash('success', 'Сохранено');

                return 1;
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка. Не удалось сохранить');

                return 0;
            }
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

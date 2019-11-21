<?php

namespace backend\controllers;

use Yii;
use common\models\Languages;
use backend\models\LanguagesSearch;
use yii\caching\TagDependency;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

class LanguagesController extends Controller
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
        $searchModel = new LanguagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Languages();  

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Новый язык",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                TagDependency::invalidate(Yii::$app->cache, 'site_languages');
                Yii::$app->session->setFlash('success', 'Новый язык добавлен.');

                return [
                    'forceClose' => true,
                    'forceReload' => '#crud-datatable-pjax'
                ];
            }else{           
                return [
                    'title'=> "Новый язык",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect('index');
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
                    'title'=> "Редактирование языка",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                TagDependency::invalidate(Yii::$app->cache, 'site_languages');
                Yii::$app->session->setFlash('success', 'Сохранено.');

                return [
                    'forceClose' => true,
                    'forceReload' => '#crud-datatable-pjax'
                ];
            }else{
                 return [
                    'title'=> "Редактирование языка",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect('index');
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionChangeMain($id)
    {
        $model = Languages::find()->all();

        if ($model) {
            foreach ($model as $item) {
                if ($item->id == $id)
                    $item->main = 1;
                else
                    $item->main = 0;

                if ($item->save()) {
                    Yii::$app->session->setFlash('success', 'Главный язык изменен.');
                } else {
                    Yii::$app->session->setFlash('success', 'Ошибка. Не удалось изменить главный язык.');
                }
            }
            return true;
        }
        return false;
    }

    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        TagDependency::invalidate(Yii::$app->cache, 'site_languages');

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Язык удален.');
        } else {
            Yii::$app->session->setFlash('error', 'Не удалось удалить язык.');
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
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', 'Языки удалены.');
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось удалить язык.');
            }
        }

        TagDependency::invalidate(Yii::$app->cache, 'site_languages');

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id)
    {
        if (($model = Languages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

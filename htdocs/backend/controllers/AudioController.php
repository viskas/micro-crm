<?php

namespace backend\controllers;

use Yii;
use backend\models\Audio;
use backend\models\AudioSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

class AudioController extends Controller
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
        $searchModel = new AudioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Audio();  

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Добавить запись",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $model->audio = UploadedFile::getInstance($model, 'audio');

                if (!empty($model->audio)) {
                    $uniqName = uniqid().Yii::$app->security->generateRandomString(10);
                    $path = Yii::getAlias('@backend') . "/web/storage/audio/{$model->id}";
                    $audio = $path . '/' . $uniqName . '.' . $model->audio->extension;

                    if (FileHelper::createDirectory($path, $mode = 0775, $recursive = true)) {
                        $model->audio->saveAs($audio);
                        $model->file = '/backend/web/storage/audio/'.$model->id.'/'.$uniqName.'.'.$model->audio->extension;
                        $model->save(false);
                    }
                }

                Yii::$app->session->setFlash('success', 'Сохранено');

                return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            }else{           
                return [
                    'title'=> "Добавить запись",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }


    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        $path = Yii::getAlias('@backend') . "/web/storage/audio/{$id}";

        if (is_dir($path)) {
            $this->delTree($path);
        }

        Yii::$app->session->setFlash('success', 'Удалено');

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
            $model->delete();
            
            $path = Yii::getAlias('@backend') . "/web/storage/audio/{$pk}";

            if (is_dir($path)) {
                $this->delTree($path);
            }

            Yii::$app->session->setFlash('success', 'Удалено');
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
        if (($model = Audio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
}

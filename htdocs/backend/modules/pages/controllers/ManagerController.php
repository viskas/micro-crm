<?php

namespace backend\modules\pages\controllers;

use common\models\News;
use Yii;
use backend\modules\pages\models\Page;
use backend\modules\pages\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\pages\Module;
use vova07\imperavi\actions\GetImagesAction;
use vova07\imperavi\actions\GetFilesAction;
use vova07\imperavi\actions\UploadFileAction;

/**
 * ManagerController implements the CRUD actions for Page model.
 * @author Belosludcev Vasilij <bupy765@gmail.com>
 * @since 1.0.0
 */
class ManagerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        /** @var \bupy7\pages\Module $module */
        $module = Yii::$app->getModule('pages');
        
        $actions = [];
        
        // add images that have already been uploaded
        if ($module->addImage) {
            $actions['images-get'] = [
                'class' => GetImagesAction::class,
                'url' => Yii::getAlias($module->urlToImages),
                'path' => Yii::getAlias($module->pathToImages),
            ];
        }
        // upload image
        if ($module->uploadImage) {
            $actions['image-upload'] = [
                'class' => UploadFileAction::class,
                'url' => Yii::getAlias($module->urlToImages),
                'path' => Yii::getAlias($module->pathToImages),
            ];
        }
        // add files that have already been uploaded
        if ($module->addFile) {
            $actions['files-get'] = [
                'class' => GetFilesAction::class,
                'url' => Yii::getAlias($module->urlToFiles),
                'path' => Yii::getAlias($module->pathToFiles),
            ];
        }
        // upload file
        if ($module->uploadFile) {
            $actions['file-upload'] = [
                'class' => UploadFileAction::class,
                'url' => Yii::getAlias($module->urlToFiles),
                'path' => Yii::getAlias($module->pathToFiles),
                'uploadOnlyImage' => false,
            ];
        }
        
        return $actions;
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'update' page.
     * @return mixed
     */
    public function actionCreate()
    {
        return $this->actionUpdate(null);
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'update' page.
     * @param integer|null $id
     * @return mixed
     */
    public function actionUpdate($id = null)
    {
        if ($id === null) {
            $model = new Page;
        } else {
            $model = Page::find()
                ->where(['id' => $id])
                ->multilingual()
                ->one();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Module::t('SAVE_SUCCESS'));
            return $this->redirect('index');
        }
        
        $module = Yii::$app->getModule('pages');
        
        return $this->render($id === null ? 'create' : 'update', [
            'model' => $model,
            'module' => $module,
            'languages' => News::availableLanguages()
        ]);
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', Module::t('DELETE_SUCCESS'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Module::t('PAGE_NOT_FOUND'));
    }
}

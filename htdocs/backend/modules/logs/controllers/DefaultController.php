<?php

namespace backend\modules\logs\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\modules\logs\Log;


class DefaultController extends Controller
{

    public $module;


    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $this->module->getLogs(),
                'sort' => [
                    'attributes' => [
                        'name',
                        'size' => ['default' => SORT_DESC],
                        'updatedAt' => ['default' => SORT_DESC],
                    ],
                ],
                'pagination' => ['pageSize' => 0],
            ]),
        ]);
    }

    public function actionView($slug, $stamp = null)
    {
        $log = $this->find($slug, $stamp);
        if ($log->isExist) {
            return Yii::$app->response->sendFile($log->fileName, $log->downloadName, ['inline' => true]);
        } else {
            throw new NotFoundHttpException('Log not found.');
        }
    }

    public function actionArchive($slug)
    {
        if ($this->find($slug, null)->archive(date('YmdHis'))) {
            return $this->redirect(['history', 'slug' => $slug]);
        } else {
            throw new NotFoundHttpException('Log not found.');
        }
    }

    public function actionHistory($slug)
    {
        $log = $this->find($slug, null);

        return $this->render('history', [
            'name' => $log->name,
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $this->module->getHistory($log),
                'sort' => [
                    'attributes' => [
                        'fileName',
                        'size' => ['default' => SORT_DESC],
                        'updatedAt' => ['default' => SORT_DESC],
                    ],
                    'defaultOrder' => ['updatedAt' => SORT_DESC],
                ],
            ]),
        ]);
    }

    protected function find($slug, $stamp)
    {
        if ($log = $this->module->findLog($slug, $stamp)) {
            return $log;
        } else {
            throw new NotFoundHttpException('Log not found.');
        }
    }
}

<?php

namespace common\modules\logger\controllers;

use Yii;
use common\modules\logger\model\ActionLog;
use common\modules\logger\model\ActionLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class LogController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        if($post = Yii::$app->request->post()){
            if(isset($post['download'])) {
                $file = \Yii::createObject([
                    'class' => 'codemix\excelexport\ExcelFile',
                    'sheets' => [
                        'Users' => [
                            'class' => 'codemix\excelexport\ActiveExcelSheet',
                            'query' => ActionLog::find(),
                        ]
                    ]
                ]);
                $file->send('actions_' . date('d-m-Y') . '.xlsx');
            } else if (isset($post['delete'])) {
                ActionLog::deleteAll();
                Yii::$app->session->setFlash('success', Yii::t('app', 'Записи удалены'));
            }
        }

        $searchModel = new ActionLogSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = ActionLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

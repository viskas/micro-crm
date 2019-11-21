<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var cakebake\actionlog\model\ActionLogSearch $searchModel
 */

$this->title = Yii::t('actionlog', 'Действия');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="flex">
        <form method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <input type="hidden" value="1" name="download">
            <button class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"> <?= Yii::t('app', 'Скачать') ?></i></button>
        </form>
        <form method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <input type="hidden" value="1" name="delete">
            <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"> <?= Yii::t('app', 'Очистить') ?></i></button>
        </form>
    </div>

    <?= \common\widgets\Alert::widget() ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '#',
            ],
            // 'category',
            // 'action',
            [
                'attribute' => 'user_id',
                'value'     => function($model) {
                	$first_name = isset($model->user->first_name) ? $model->user->first_name : '';
                	$last_name = isset($model->user->first_name) ? $model->user->last_name : '';
                    return $first_name . ' ' . $last_name . ' (ID:' . $model->user_id . ')';
                }
            ],
            'user_remote',
            'message:ntext',
            [
                'attribute' => 'status',
                'format'    => 'raw',
                'filter'    => [
                    'success'   => Yii::t('app', 'Успешно'),
                    'error'     => Yii::t('app', 'Ошибка'),
                ],
                'value'     => function($model) {
                    return $model->status == 'success' ? '<span class="label label-success">' . Yii::t('app', 'Успешно') . '</span>' : '<span class="label label-danger">' . Yii::t('app', 'Ошибка') . '</span>';
                }
            ],
            [
                'attribute' => 'time',
                'filter'    => kartik\date\DatePicker::widget([
                                    'name' => 'ActionLogSearch[time]', 
                                    'value' => date('Y-m-d'),
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true
                                    ]
                                ]),
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>

</div>

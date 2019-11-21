<?php
use yii\helpers\Url;

return [
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id',
        'width' => '60px'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'first_name',
        'value' => function ($model) {
            return $model->first_name . ' ' . $model->last_name;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'platform',
        'filter' => \kartik\select2\Select2::className(),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'data' => $systems,
            'options' => ['class' => 'form-control', 'prompt' => 'Все'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'account_number',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone_number',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'filter' => \kartik\select2\Select2::className(),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'data' => $statuses,
            'options' => ['class' => 'form-control', 'prompt' => 'Все'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'created_at',
        'value' => function ($model) {
            return date('d.m.Y', strtotime($model->created_at));
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'width' => '100px',
        'template' => '{view} {update}',
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['title'=>'Просмотр', 'class' => 'btn btn-info', 'data-pjax' => false],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Редактирование', 'data-toggle'=>'tooltip', 'class' => 'btn btn-xs btn-primary'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Удаление',
                          'data-confirm'=>false, 'data-method'=>false,
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   
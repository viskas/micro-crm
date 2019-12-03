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
        'label' => 'Менеджер',
        'attribute'=>'user_id',
        'value' => function ($model) {
            $last_name = isset($model->user->last_name) ? $model->user->last_name : '';
            return $model->user->first_name . ' ' . $last_name;
        },
        'filter' => \kartik\select2\Select2::className(),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'data' => $users,
            'options' => ['class' => 'form-control', 'prompt' => 'Все'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ],
        'width' => '150px'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Имя клиента',
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
        'width' => '90px'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone_number',
        'width' => '150px'
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
        'attribute'=>'filter',
        'filter' => \kartik\select2\Select2::className(),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'data' => $filters,
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
        },
        'width' => '150px'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'width' => '100px',
        'template' => '{view} {delete}',
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['title'=>'Просмотр', 'class' => 'btn btn-info btn-xs', 'data-pjax' => false],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Редактирование', 'data-toggle'=>'tooltip', 'class' => 'btn btn-xs btn-primary'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Удаление',
                          'data-confirm'=>false, 'data-method'=>false,
                          'data-request-method'=>'post',
                          'class' => 'btn btn-danger btn-xs',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Вы уверены?',
                          'data-confirm-message'=>'Вы точно хотите удалить клиента?'],
    ],

];   
<?php
use yii\helpers\Url;

return [
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id',
        'width' => '50px'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header'=>'Клиент',
        'value' => function ($model) {
            $lastName = isset($model->client->last_name) ? $model->client->last_name : '';

            return $model->client->first_name . ' ' . $lastName;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'date',
        'contentOptions' => ['class' => 'text-center'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'time',
        'contentOptions' => ['class' => 'text-center'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'comment',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'format' => 'raw',
        'value' => function ($model) {
            return $model->status == 1 ? '<label class="label label-success">Выполнен</label>' : '<label class="label label-danger">В ожидании</label>';
        },
        'filter' => \yii\helpers\Html::activeDropDownList($searchModel,
            'status',
            [
                0 => 'В ожидании',
                1 => 'Выполнен',
            ],
            [
                'class' => 'form-control',
                'prompt' => 'Все'
            ]
        ),
        'contentOptions' => ['class' => 'text-center'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'created_at',
        'value' => function ($model) {
            return date('Y-m-d H:i', strtotime($model->created_at));
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{update}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Просмотр','data-toggle'=>'tooltip', 'class' => 'btn btn-xs btn-info'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Редактирование', 'data-toggle'=>'tooltip', 'class' => 'btn btn-xs btn-primary'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   
<?php
use yii\helpers\Url;
use common\models\Languages;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'language',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'code',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'main',
        'format' => 'raw',
        'value' => function ($model) {
            return $model->main == Languages::STATUS_MAIN ? '<span class="label label-success">Главный</span>' : '';
        },
        'filter' => \yii\helpers\Html::activeDropDownList($searchModel,
            'main',
            [
                Languages::STATUS_MAIN => 'Главный',
                0 => 'Не главный'
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
        'format' => 'raw',
        'attribute' => 'status',
        'value' => function ($model) {
            return $model->status == Languages::STATUS_ACTIVE ? '<span class="label label-success">Активный</span>' : '<span class="label label-danger">Удален</span>';
        },
        'filter' => \yii\helpers\Html::activeDropDownList($searchModel,
            'status',
            [
                Languages::STATUS_ACTIVE => 'Активный',
                Languages::STATUS_DISABLED => 'Удален'
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
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'width' => '100px',
        'vAlign'=>'middle',
        'template' => '{update} {delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Редактировать', 'data-toggle'=>'tooltip', 'class' => 'btn btn-primary'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Заблокировать',
                          'data-confirm'=>false, 'data-method'=>false,
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'class' => 'btn btn-danger',
                          'data-confirm-title'=>'Вы уверены?',
                          'data-confirm-message'=>'Вы точно хотите заблокировать/разблокировать язык?'],
    ],

];   
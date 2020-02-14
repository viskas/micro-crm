<?php
use yii\helpers\Url;

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
        'attribute'=>'user_id',
        'value' => function ($model) {
            return $model->user->first_name . ' ('.$model->user->email.')';
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'file',
        'format' => 'raw',
        'value' => function ($model) {
            if (!$model->file) {
                return ' - ';
            }
            return '<audio controls><source src="'.$model->file.'" type="audio/mpeg"></audio>';
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'title',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'description',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'created_at',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => \mdm\admin\components\Helper::filterActionColumn('{delete}'),
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Удалить',
                          'class' => 'btn btn-danger btn-xs',
                          'data-confirm'=>false, 'data-method'=>false,
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Вы уверены?',
                          'data-confirm-message'=>'Вы точно хотите удалить запись?'],
    ],

];   
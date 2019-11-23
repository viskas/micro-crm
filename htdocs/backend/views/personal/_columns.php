<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'id',
        'label' => 'ID',
        'width' => '70px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => 'Имя',
        'attribute'=>'first_name',
        'value' => function ($model) {
            $last_name = $model->last_name ?? '';
            return $model->first_name . ' ' . $last_name;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Роль',
        'value' => function ($model) {
            return $model->role->item_name;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'format' => 'raw',
        'attribute' => 'status',
        'value' => function ($model) {
            return $model->status == \common\models\User::STATUS_ACTIVE ? '<span class="label label-success">Активный</span>' : '<span class="label label-danger">Заблокирован</span>';
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'created_at',
        'value' => function ($model) {
            return date('Y-m-d H:i', $model->created_at);
        },
        'width' => '135px'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'width' => '129px',
        'template' => '{update} {qr} {delete}',
        'buttons' => [
            'qr' => function ($url, $model, $key) {
                return \yii\helpers\Html::a('<span class="glyphicon glyphicon-erase"></span>', ['reset-qr', 'id' => $key], [
                    'class' => 'btn btn-default btn-xs',
                    'role' => 'modal-remote',
                    'data-toggle' => 'tooltip',
                    'title' => 'Сбросить QR код',
                    'data-request-method'=>'post',
                    'data-confirm-title'=>'Вы уверены?',
                    'data-confirm-message'=>'Вы точно хотите cбросить QR код пользователю?'
                ]);
            },
        ],
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
            return Url::to([$action,'id'=>$key]);
        },
        'updateOptions'=>['role'=>'modal-remote','title'=>'Отредактировать', 'data-toggle'=>'tooltip', 'class' => 'btn btn-primary btn-xs'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Заблокировать/разблокировать',
            'class' => 'btn btn-danger btn-xs',
            'data-confirm'=>false, 'data-method'=>false,
            'data-request-method'=>'post',
            'data-toggle'=>'tooltip',
            'data-confirm-title'=>'Вы уверены?',
            'data-confirm-message'=>'Вы точно хотите заблокировать/разблокировать пользователя?'],
    ],

];   
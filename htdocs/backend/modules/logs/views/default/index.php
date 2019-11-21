<?php
use yii\grid\GridView;
use yii\helpers\Html;
use backend\modules\logs\Log;

$this->title = 'Логи';
$this->params['breadcrumbs'][] = 'Логи';
?>

<div class="h1">Логи и ошибки</div>

<div class="logreader-index">
    <?= GridView::widget([
        'layout' => '{items}',
        'tableOptions' => ['class' => 'table'],
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'label' => 'Имя файла',
                'format' => 'raw',
                'value' => function (Log $log) {
                    return Html::tag('h5', join("\n", [
                        Html::encode($log->name),
                        '<br/>',
                        Html::tag('small', Html::encode($log->fileName)),
                    ]));
                },
            ],
            [
                'attribute' => 'counts',
                'label' => 'Количество',
                'format' => 'raw',
                'headerOptions' => ['class' => 'sort-ordinal'],
                'value' => function (Log $log) {
                    return $this->render('_counts', ['log' => $log]);
                },
            ],
            [
                'attribute' => 'size',
                'label' => 'Размер',
                'format' => 'shortSize',
                'headerOptions' => ['class' => 'sort-ordinal'],
            ],
            [
                'attribute' => 'updatedAt',
                'label' => 'Последняя запись',
                'format' => 'relativeTime',
                'headerOptions' => ['class' => 'sort-numerical'],
            ],
            [
                'class' => '\yii\grid\ActionColumn',
                'template' => '{history} {view} {archive}',
                'urlCreator' => function ($action, Log $log) {
                    return [$action, 'slug' => $log->slug];
                },
                'buttons' => [
                    'history' => function ($url) {
                        return Html::a('История', $url, [
                            'class' => 'btn btn-xs btn-default',
                        ]);
                    },
                    'view' => function ($url, Log $log) {
                        return !$log->isExist ? '' : Html::a('Просмотр', $url, [
                            'class' => 'btn btn-xs btn-default',
                            'target' => '_blank',
                        ]);
                    },
                    'archive' => function ($url, Log $log) {
                        return !$log->isExist ? '' : Html::a('В архив', $url, [
                            'class' => 'btn btn-xs btn-default',
                            'data' => ['method' => 'post', 'confirm' => 'Вы уверены?'],
                        ]);
                    },
                ],
            ],
        ],
    ]) ?>
</div>
<?php
$this->registerCss(<<<CSS

.logreader-index .table tbody td {
    vertical-align: middle;
}

CSS
);
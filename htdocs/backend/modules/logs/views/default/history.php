<?php
use yii\grid\GridView;
use yii\helpers\Html;
use backend\modules\logs\Log;

$this->title = $name;
$this->params['breadcrumbs'][] = ['label' => 'Логи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $name;
?>

<h1>История "<?= $name ?>"</h1>

<div class="logreader-history">
    <?= GridView::widget([
        'tableOptions' => ['class' => 'table'],
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'fileName',
                'label' => 'Имя файла',
                'format' => 'raw',
                'value' => function (Log $log) {
                    return pathinfo($log->fileName, PATHINFO_BASENAME);
                },
            ],
            [
                'attribute' => 'counts',
                'label' => 'Количество',
                'format' => 'raw',
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
                'template' => '{view}',
                'urlCreator' => function ($action, Log $log) {
                    return [$action, 'slug' => $log->slug, 'stamp' => $log->stamp];
                },
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('Просмотр', $url, [
                            'class' => 'btn btn-xs btn-default',
                            'target' => '_blank',
                        ]);
                    },
                ],
            ],
        ],
    ]) ?>
</div>
<?php
$this->registerCss(<<<CSS

.logreader-history .table tbody td {
vertical-align: middle;
}

CSS
);
<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;

$this->title = 'Мои клиенты';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="clients-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'hover' => true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Добавить клиента','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Обновить']).
                    '{toggleData}'
                ],
            ],
            'striped' => false,
            'condensed' => true,
            'responsive' => true,
            'options' => [
                'style' => 'overflow: auto; word-wrap: break-word;'
            ],
            'panel' => [
                'type' => 'default',
                'footer' => false,
                'heading' => '<i class="glyphicon glyphicon-list"></i> Мои клиенты',
                'after'=> '<div class="clearfix"></div>'.
                          '<div class="pull-right">{pager}</div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    'size' => 'modal-lg',
    "footer"=>"",
])?>
<?php Modal::end(); ?>

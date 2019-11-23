<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;

$this->title = 'Мои звонки';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="client-calls-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Добавить звонок','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Обновить']).
                    '{toggleData}'
                ],
            ],
            'options' => [
                'style' => 'overflow: auto; word-wrap: break-word;'
            ],
            'hover' => true,
            'striped' => false,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default',
                'footer' => false,
                'heading' => '<i class="glyphicon glyphicon-list"></i> Мои звонки',
                'after'=>\backend\widgets\BulkButtonWidget::widget([
                        'buttons'=>Html::a('Удалить выбранные',
                            ["bulk-delete"] ,
                            [
                                "class"=>"btn btn-danger btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'Вы уверены?',
                                'data-confirm-message'=>'Вы точно хотите удалить выбранные звонки?'
                            ]),
                    ]).
                    '<div class="clearfix"></div>'.
                    '<div class="pull-right">{pager}</div>'
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

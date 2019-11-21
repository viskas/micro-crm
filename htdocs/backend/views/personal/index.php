<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use backend\widgets\BulkButtonWidget;

CrudAsset::register($this);

$this->title = 'Персонал';
?>

<div class="personal-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'hover'=>true,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                        ['role'=>'modal-remote','title'=> 'Добавить нового пользователя','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Обновить']).
                    '{toggleData}'
                ],
            ],
            'exportConfig' => [
                GridView::EXCEL => true,
                GridView::CSV => true,
                GridView::PDF => true
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
                'heading' => '<i class="glyphicon glyphicon-user"></i> Персонал',
                'after'=>BulkButtonWidget::widget([
                        'buttons'=>Html::a('Заблокировать/разблокировать выбранных',
                            ["bulk-delete"] ,
                            [
                                "class"=>"btn btn-danger btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'Вы уверены?',
                                'data-confirm-message'=>'Вы точно хотите заблокировать/разблокировать выбранных пользователей?'
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
    "footer"=>"",
])?>
<?php Modal::end(); ?>

<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use backend\widgets\BulkButtonWidget;

$this->title = Yii::t('app', 'Языки');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="languages-index">
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
                    ['role'=>'modal-remote','title'=> 'Добавить язык','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Обновите']).
                    '{toggleData}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'options' => [
                'style' => 'overflow: auto; word-wrap: break-word;'
            ],
            'panel' => [
                'type' => 'вуафгде',
                'footer' => false,
                'heading' => '<i class="glyphicon glyphicon-list"></i> Список языков',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('Заблокировать / Разблокировать',
                                ["bulk-delete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Вы уверены?',
                                    'data-confirm-message'=>'Вы точно хотите заблокировать/Разблокировать выбранные языки?'
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

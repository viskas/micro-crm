<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use backend\widgets\BulkButtonWidget;
use mdm\admin\components\Helper;

$this->title = 'Аудиозаписи';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

$update = Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Обновить')]). '{toggleData}';
$pager = '<div class="clearfix"></div>' . '<div class="pull-right">{pager}</div>';
?>
<div class="audio-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Helper::checkRoute('create') ?
                        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                            ['role'=>'modal-remote','title'=> 'Добавить аудиозапись','class'=>'btn btn-default']).$update
                        : $update
                ],
            ],
            'hover'=>true,
            'striped' => false,
            'condensed' => true,
            'responsive' => true,
            'options' => [
                'style' => 'overflow: auto; word-wrap: break-word;'
            ],
            'panel' => [
                'type' => 'default',
                'footer' => false,
                'heading' => '<i class="glyphicon glyphicon-list"></i> Список аудиозаписей',
                'after'=> Helper::checkRoute('delete') ? BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Удалить выбранные',
                                ["bulk-delete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Вы уверены?',
                                    'data-confirm-message'=>'Вы точно хотите удалить выбранные записи?'
                                ]),
                        ]).$pager : $pager
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",
])?>
<?php Modal::end(); ?>

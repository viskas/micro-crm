<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\pages\Module;
use backend\modules\pages\models\Page;

/* @var $this yii\web\View */
/* @var $searchModel bupy7\pages\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статические страницы';
?>

<p>
    <?= Html::a(Module::t('Добавить страницу'), ['create'], ['class' => 'btn btn-success']); ?>
</p>

<?php Pjax::begin([
    'id' => 'grid',
    'scrollTo' => true
]) ?>
    <?= GridView::widget([
        'tableOptions' => [
            'class' => 'table table-striped',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'alias',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'published',
                'filter' => Page::publishedDropDownList(),
                'value' => function ($model) {
                    return Yii::$app->formatter->asBoolean($model->published);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update}\n{delete}",
            ],
        ],
    ]); ?>
<?php Pjax::end() ?>

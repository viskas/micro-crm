<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ClientCalls */
?>
<div class="client-calls-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'client_id',
            'date',
            'time',
            'comment:ntext',
            'status',
            'created_at',
        ],
    ]) ?>

</div>

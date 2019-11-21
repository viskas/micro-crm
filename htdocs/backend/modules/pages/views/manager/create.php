<?php

use yii\helpers\Html;
use backend\modules\pages\Module;

/* @var $this yii\web\View */
/* @var $model bupy7\pages\models\Page */
/* @var $module bupy7\pages\Module */

$this->title = 'Создание страницы';
?>

<div class="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
</div>

<?= $this->render('_form', [
    'model' => $model,
    'module' => $module,
    'languages' => $languages
]); ?>

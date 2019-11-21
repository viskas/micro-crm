<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\models\News;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin([
    'id' => 'pjax-container',
    'scrollTo' => true,
    'timeout' => false
]) ?>

<div class="menu_left">
    <?= $this->renderAjax('@frontend/views/layouts/partial/account_menu_mobile_block') ?>

    <?= $this->renderAjax('@frontend/views/main/partial/menu') ?>

    <?= $this->renderAjax('@frontend/views/main/partial/platform') ?>
</div>

<div id="custom_overlay">
    <div class="hidden-overlay">
        <div class="content_cur">
            <div class="content_cur_left">
            <ul class="breadcrumbs">
                <li class="icon-home"><?= Yii::t('app', 'Главная') ?></li>
	            <li> / </li>
	            <li><?= $model->title ?></li>
            </ul>

            <div class="content_cur_bg">
            	<?= $model->content; ?>
            </div>

            <?= $this->render('@frontend/views/main/partial/license') ?>
        </div>
    </div>
</div>

<?php Pjax::end() ?>


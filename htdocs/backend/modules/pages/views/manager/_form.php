<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\pages\Module;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model bupy7\pages\models\Page */
/* @var $form yii\widgets\ActiveForm */
/* @var $module bupy7\pages\Module */

$form = ActiveForm::begin();

echo $form->field($model, 'alias')->textInput(['maxlength' => 255]);

echo $form->field($model, 'published')->checkbox();

$settings = [
    'minHeight' => 200,
    'plugins' => [
        'fullscreen',
    ],
];

if ($module->imperaviLanguage) {
    $settings['lang'] = $module->imperaviLanguage;
}
if ($module->addImage || $module->uploadImage) {
    $settings['plugins'][] = 'imagemanager';
}
if ($module->addImage) {
    $settings['imageManagerJson'] = Url::to(['images-get']);
}
if ($module->uploadImage) {
    $settings['imageUpload'] = Url::to(['image-upload']);
}
if ($module->addFile || $module->uploadFile) {
    $settings['plugins'][] = 'filemanager';
}
if ($module->addFile) {
    $settings['fileManagerJson'] = Url::to(['files-get']);
}
if ($module->uploadFile) {
    $settings['fileUpload'] = Url::to(['file-upload']);
}

?>


<?php if ($languages): ?>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active" ><a href="#tab_ru" data-toggle="tab" aria-expanded="true">ru</a></li>
            <?php foreach ($languages as $language): ?>
                <?php if ($language != 'ru'): ?>
                    <li><a href="#tab_<?= $language ?>" data-toggle="tab" aria-expanded="true"><?= $language ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_ru">
                <?= $form->field($model, 'title')->textInput(['maxlength' => 255]); ?>

                <?= $form->field($model, 'content')->widget(Imperavi::class, [
                    'settings' => $settings
                ]); ?>

                <?= $form->field($model, 'title_browser')->textInput(['maxlength' => 255]); ?>

                <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => 200]); ?>

                <?= $form->field($model, 'meta_description')->textInput(['maxlength' => 160]); ?>
            </div>
            <?php foreach ($languages as $language): ?>
                <?php if ($language != 'ru'): ?>
                    <div class="tab-pane" id="tab_<?= $language ?>">
                        <?= $form->field($model, 'title_'.$language)->textInput(['maxlength' => 255]); ?>

                        <?php $settings['lang'] = $language ?>

                        <?= $form->field($model, 'content_'.$language)->widget(Imperavi::class, [
                            'settings' => $settings
                        ]); ?>

                        <?= $form->field($model, 'title_browser_'.$language)->textInput(['maxlength' => 255]); ?>

                        <?= $form->field($model, 'meta_keywords_'.$language)->textInput(['maxlength' => 200]); ?>

                        <?= $form->field($model, 'meta_description_'.$language)->textInput(['maxlength' => 160]); ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]); ?>

    <?= $form->field($model, 'content')->widget(Imperavi::class, [
        'settings' => $settings
    ]); ?>

    <?= $form->field($model, 'title_browser')->textInput(['maxlength' => 255]); ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => 200]); ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => 160]); ?>
<?php endif; ?>


<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Module::t('CREATE') : Module::t('UPDATE'), [
        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
    ]); ?>
</div>

<?php ActiveForm::end(); ?>

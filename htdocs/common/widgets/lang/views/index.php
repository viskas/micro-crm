<?php 

use yii\helpers\Url;

?>
<?php if ($languages = \backend\helpers\MainHelper::ActiveLanguages()): ?>
        <select id="lang_dropdown" class="language">
            <?php foreach ($languages as $language): ?>
                <option <?= \Yii::$app->language == $language->code ? 'selected' : '' ?> value="<?= Url::to(['/site/language', 'code' => $language->code, 'route' => Yii::$app->controller->route, 'get' => Yii::$app->request->get()]); ?>" class="lang-<?= $language->code ?>"><?= strtoupper($language->code) ?></option>
            <?php endforeach; ?>
        </select>
<?php endif; ?>

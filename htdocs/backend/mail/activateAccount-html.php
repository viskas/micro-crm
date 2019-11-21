<?php
use yii\helpers\Html;

$link = Yii::$app->urlManager->createAbsoluteUrl(['/site/login']);
?>

<div class="password-reset">
    <p>Вам разрешен доступ в панель администрации. (<a href="<?= $link ?>"><?= $link ?></a>)</p>
    <p><b>Логин:</b> <?= $login ?></p>
    <p><b>Пароль:</b> <?= $password ?></p>
</div>
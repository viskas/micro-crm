<?php
use yii\helpers\Html;
$link = Yii::$app->urlManager->createAbsoluteUrl(['site/index', 'token' => $user->auth_key]);
?>

<div class="container">
    <h4>Здравствуйте, <?= $user->first_name ?> <?= $user->last_name ?>.</h4>
    <p>Вы успешно прошли регистрацию и осталось только подтвердите ваш аккаунт: <?= Html::a('Подтвердить аккаунт', $link) ?></p>
    <p>С уважением, Администрация.</p>
</div>
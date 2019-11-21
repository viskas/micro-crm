<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/frontend/web/images/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/frontend/web/images/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/frontend/web/images/fav/favicon-16x16.png">
    <link rel="manifest" href="/frontend/web/images/fav/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-page">

<?php $this->beginBody() ?>

    <?= Alert::widget() ?>
    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

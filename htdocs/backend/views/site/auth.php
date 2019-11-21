<?php

$this->title = 'Проверочный код';
?>

<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Админ</b>Панель</a>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Пожалуйста, введите код</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => true]); ?>

        <div class="form-group has-feedback field-loginform-email required" style="margin-top: 30px">
            <input id="loginform-email" class="form-control" name="code" placeholder="Код" aria-required="true" type="text"><span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <p class="help-block help-block-error"></p>
        </div>

        <div class="row">
            <div class="col-xs-8"></div>

            <div class="col-xs-4">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>


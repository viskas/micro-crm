<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Новый пароль';
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#">Новый пароль</a>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Введите новый пароль</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => true]); ?>

        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control'])->label(false) ?>

        <div class="row">
            <div class="col-xs-8"></div>

            <div class="col-xs-4">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'reset-password-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>


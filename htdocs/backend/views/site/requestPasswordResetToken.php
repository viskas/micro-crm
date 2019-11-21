<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сброс пароля';
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#">Сброс пароля</a>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Мы отправим вам письмо с дальнейшими инструкциями</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => true]); ?>

            <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder' => 'Ваш email'])->label(false) ?>

            <div class="row">
                <div class="col-xs-8"></div>

                <div class="col-xs-4">
                    <?= Html::submitButton('Сбросить', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'reset-password-button']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

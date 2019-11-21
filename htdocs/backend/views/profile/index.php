<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;

$this->title = 'Мой профиль';
?>

<div class="row">
    <div class="col-md-6">
        <?php Pjax::begin([
            'id' => 'profile-pjax',
            'timeout' => false,
            'enablePushState' => false
        ]) ?>
            <?php $form = ActiveForm::begin([
                'options' => ['data-pjax' => true],
                'id' => 'profile-form',
                'action' => '/admin/profile/index'
            ]); ?>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset>
                            <legend class="text-semibold">Данные профиля</legend>
                            <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder' => 'Ваш email']) ?>
                        </fieldset>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        <?php Pjax::end() ?>

        <div class="panel panel-flat">
            <div class="panel-body">
                <fieldset>
                    <legend class="text-semibold">Двухфакторная авторизация (Google)</legend>

                    <?php if ($user->qr_status == 0): ?>
                        <div class="form-group field-profile-qr" id="qr-check">
                            <label>
                                <input id="qr-auth" name="qr" value="0" type="checkbox">
                                Включить
                            </label>
                        </div>
                    <?php else: ?>
                        <h4>Включена</h4>
                        <div class="form-group field-profile-qr" id="qr-check-disable">
                            <label>
                                <input id="qr-auth-disable" name="qr-disable" value="1" type="checkbox">
                                Выключить
                            </label>
                        </div>

                        <div class="login-box-body" id="qr-auth-form" style="display: none">
                            <p class="login-box-msg">Пожалуйста, введите код</p>
                            <?php $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'action' => '/admin/profile/qr-code-disable',
                                'enableClientValidation' => true,
                                'options' => ['data-pjax' => true],
                            ]); ?>
                            <div class="form-group has-feedback field-loginform-email required" style="margin-top: 30px">
                                <input id="loginform-email" class="form-control" name="code" placeholder="Код" aria-required="true" type="text"><span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                <p class="help-block help-block-error"></p>
                            </div>

                            <div class="row">
                                <div class="col-md-9"></div>
                                <div class="col-md-3" style="float: right">
                                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    <?php endif; ?>
                    <div id="qr-block"></div>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <?php Pjax::begin([
            'id' => 'change-password-pjax',
            'timeout' => false,
            'enablePushState' => false
        ]) ?>
            <?php $form = ActiveForm::begin([
                'id' => 'change-password-form',
                'action' => '/admin/profile/change-password',
                'options' => ['data-pjax' => true]
            ]); ?>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset>
                            <legend class="text-semibold">Смена пароля</legend>

                            <?= $form->field($pass, 'currentPassword', ['enableAjaxValidation' => true])->passwordInput() ?>

                            <?= $form->field($pass, 'newPassword')->passwordInput() ?>

                            <?= $form->field($pass, 'newPasswordConfirm')->passwordInput() ?>

                        </fieldset>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        <?php Pjax::end() ?>
    </div>
</div>
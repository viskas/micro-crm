<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="clients-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'platform')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'account_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'phone_number')->widget(\borales\extensions\phoneInput\PhoneInput::className(), [
                'jsOptions' => [
                    'preferredCountries' => ['ru', 'ua'],
                    'nationalMode' => false,
                ]
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'additional_phone_number')->widget(\borales\extensions\phoneInput\PhoneInput::className(), [
                'jsOptions' => [
                    'preferredCountries' => ['ru', 'ua'],
                    'nationalMode' => false,
                ]
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'birthday')->widget(\kartik\date\DatePicker::classname(), [
                'pluginOptions' => [
                    'autoclose'=>true,
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'autoclose' => true
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'team_viewer')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'additional_info')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

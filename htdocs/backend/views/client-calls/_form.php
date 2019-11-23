<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$data = \common\models\Clients::find()->where(['user_id' => Yii::$app->user->identity->getId()])->orderBy(['created_at' => SORT_DESC])->all();
?>

<div class="client-calls-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map($data, 'id', 'first_name'),
        'language' => Yii::$app->language,
        'options' => ['placeholder' => Yii::t('app', 'Выберите пользователя...')],
        'pluginOptions' => [
            'allowClear' => true,
            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'date')->widget(\kartik\date\DatePicker::classname(), [
                'pluginOptions' => [
                    'autoclose'=>true,
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'todayHighlight' => true
                    ]
                ]
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'time')->widget(\kartik\time\TimePicker::classname(), [
                'pluginOptions' => [
                    'autoclose' => true,
                    'showMeridian' => false,
                    'defaultTime' => '11:00'
                ]
            ]); ?>
        </div>
    </div>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        '0' => 'В ожидании',
        '1' => 'Выполнен'
    ]) ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

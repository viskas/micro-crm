<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\User;
?>

<div class="audio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'audio')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->where(['status' => 10])->orderBy(['created_at' => SORT_DESC])->all(), 'id', 'first_name'),
        'language' => Yii::$app->language,
        'options' => ['placeholder' => Yii::t('app', 'Выберите пользователя...')],
        'pluginOptions' => [
            'allowClear' => true,
            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
        ],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

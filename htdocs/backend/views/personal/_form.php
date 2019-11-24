<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="personal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput() ?>

    <?= $form->field($model, 'last_name')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?php if ($model->isNewRecord): ?>
        <?= $form->field($model, 'password')->textInput(['placeholder' => 'Будет сгенерирован автоматически']) ?>

        <div class="form-group">
            <label>Роль:</label>

            <label class="radio-inline">
                <input type="radio" class="styled" name="Personal[role]" value="Администратор" checked="checked">
                Администратор
            </label>

            <label class="radio-inline">
                <input type="radio" class="styled" name="Personal[role]" value="Аналитик">
                Аналитик
            </label>
        </div>
    <?php endif; ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

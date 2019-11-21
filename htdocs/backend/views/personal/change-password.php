<?php
use yii\widgets\ActiveForm;
?>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin() ?>
        <div class="form-group">
            <label for="exampleInputPassword1">Новый пароль</label>
            <input type="text" name="new-password" class="form-control" placeholder="Пароль" required>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>

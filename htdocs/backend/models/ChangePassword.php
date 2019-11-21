<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;

class ChangePassword extends Model
{
    public $newPassword;
    public $currentPassword;
    public $newPasswordConfirm;

    public function rules()
    {
        return [
            [['newPassword', 'currentPassword', 'newPasswordConfirm'], 'required'],
            [['currentPassword'], 'validateCurrentPassword'],
            [['newPassword', 'newPasswordConfirm'], 'string', 'min' => 6],
            [['newPassword', 'newPasswordConfirm'], 'filter', 'filter' => 'trim'],
            [['newPasswordConfirm'], 'compare', 'compareAttribute' => 'newPassword', 'message' => 'Пароли не совпадают!'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'currentPassword' => 'Текущий пароль',
            'newPassword' => 'Новый пароль',
            'newPasswordConfirm' => 'Подтверждение нового пароля',
        ];
    }

    public function validateCurrentPassword()
    {
        if (!$this->verifyPassword($this->currentPassword)) {
            $this->addError("currentPassword", 'Текущий пароль не верный!');
        }
    }

    public function verifyPassword($password)
    {
        $dbpassword = User::findOne(['email' => Yii::$app->user->identity->email])->password_hash;

        return Yii::$app->security->validatePassword($password, $dbpassword);
    }
}
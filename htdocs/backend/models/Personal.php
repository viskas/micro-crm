<?php

namespace backend\models;

use common\helpers\KeyHelper;
use common\models\Details;
use common\models\User;
use Yii;
use borales\extensions\phoneInput\PhoneInputValidator;


class Personal extends \yii\db\ActiveRecord
{
    public $password;

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['first_name', 'email'], 'required'],
            [['is_user', 'qr_status', 'status', 'created_at', 'updated_at'], 'integer'],
            [['last_name', 'email'], 'string', 'max' => 255],
            [['email', 'username'], 'unique'],
            [['email'], 'email'],
            [['password'], 'string', 'min' => 6],
        ];
    }


    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'secret_key' => 'Secret Key',
            'password' => 'Пароль',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'qr_status' => 'Qr Status',
            'status' => 'Статус',
            'created_at' => 'Дата регистрации',
        ];
    }

    public function getRole()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id']);
    }

    public function RegisterStaff($request)
    {
        $user = new User();
        $key_helper = new KeyHelper();
        $auth_assignment = new AuthAssignment();

        $password = !empty($request['password']) ? $request['password'] : uniqid();
        $user->password_hash = Yii::$app->security->generatePasswordHash($password);
        $user->email = $request['email'];
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->generateAuthKey();
        $user->secret_key = $key_helper->createSecret();
        if($user->save()){
            $auth_assignment->item_name = $request['role'];
            $auth_assignment->user_id = $user->id;
            $auth_assignment->created_at = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));

            if($auth_assignment->save()){
                $this->SendActivateEmail($user->email, $password, $user->email);

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function SendActivateEmail($login, $password, $to_email)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'activateAccount-html'],
                [
                    'login' => $login,
                    'password' => $password
                ]
            )
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['siteName']])
            ->setTo($to_email)
            ->setSubject('Доступ в панель администрации')
            ->send();
    }
}

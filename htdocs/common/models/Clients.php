<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%clients}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $platform
 * @property string $account_number
 * @property string $phone_number
 * @property string $additional_phone_number
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 * @property string $birthday
 * @property string $address
 * @property string $skype
 * @property string $team_viewer
 * @property string $status
 * @property string $additional_info
 * @property string $created_at
 *
 * @property User $user
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%clients}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'status'], 'required'],
            [['user_id', 'is_verified'], 'integer'],
            [['birthday', 'created_at'], 'safe'],
            [['additional_info'], 'string'],
            [['platform'], 'string', 'max' => 50],
            [['account_number', 'address', 'skype', 'team_viewer'], 'string', 'max' => 255],
            [['phone_number', 'additional_phone_number', 'first_name', 'last_name', 'patronymic'], 'string', 'max' => 30],
            [['status'], 'string', 'max' => 40],
            [['filter'], 'string', 'max' => 60],
            [['id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'platform' => 'Система',
            'account_number' => '№ счета',
            'phone_number' => 'Номер телефона',
            'additional_phone_number' => 'Дополнительный номер телефона',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'patronymic' => 'Отчество',
            'birthday' => 'Дата рождения',
            'address' => 'Адрес',
            'skype' => 'Skype',
            'team_viewer' => 'Team Viewer',
            'status' => 'Статус',
            'filter' => 'Фильтр',
            'is_verified' => 'Верифицирован',
            'additional_info' => 'Дополнительная информация',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientCalls()
    {
        return $this->hasMany(ClientCalls::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientComments()
    {
        return $this->hasMany(ClientComments::className(), ['client_id' => 'id']);
    }
}

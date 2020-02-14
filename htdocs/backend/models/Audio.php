<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "{{%audio}}".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $file
 * @property string $created_at
 */
class Audio extends \yii\db\ActiveRecord
{
    public $audio;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%audio}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['title', 'file'], 'string', 'max' => 255],
            [['audio'], 'file', 'extensions' => 'mp3']
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
            'title' => 'Заголовок',
            'description' => 'Описание',
            'file' => 'Файл',
            'audio' => 'Файл',
            'created_at' => 'Дата создания',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

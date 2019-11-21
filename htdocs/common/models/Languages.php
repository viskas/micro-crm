<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Languages extends ActiveRecord
{

    const STATUS_MAIN = 1;

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;

    public static function tableName()
    {
        return 'languages';
    }

    public function rules()
    {
        return [
            [['language', 'code'], 'required'],
            [['language', 'code'], 'string', 'max' => 255],
            [['main', 'status'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'language' => 'Язык',
            'code' => 'Код',
            'status' => 'Статус',
            'main' => 'Главный язык'
        ];
    }
}
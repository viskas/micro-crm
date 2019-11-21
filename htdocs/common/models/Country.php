<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Country extends ActiveRecord
{

    public static function tableName()
    {
        return 'country';
    }

    public function rules()
    {
        return [
            [['title_ru', 'title_en'], 'required'],
            [['title_ru', 'title_en'], 'string', 'max' => 60]
        ];
    }

}
<?php

namespace backend\models;

use Yii;
use common\models\User;

class Profile extends User
{
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['email'], 'email']
        ];
    }
}
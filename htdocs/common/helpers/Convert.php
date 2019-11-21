<?php

namespace common\helpers;

use Yii;

class Convert
{

    public static function RubToUsd($value)
    {
        if ($value > 0) {
            $rate = Yii::$app->settings->get('rub_rate', 'main');
            return round($value / (float)$rate,2);
        }
    }

    public static function UsdToRub($value)
    {
        if ($value > 0) {
            $rate = Yii::$app->settings->get('rub_rate', 'main');
            return round($value * (float)$rate,2);
        }
    }
}
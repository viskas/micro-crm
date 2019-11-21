<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use backend\models\Settings;

class CurrencyController extends Controller
{
    public function actionRubUsd()
    {
        $result = file_get_contents("http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req=".date("d/m/Y"));
        preg_match_all('|<Valute ID=".*">.*<NumCode>.*</NumCode>.*<CharCode>(.*)</CharCode>.*<Nominal>(.*)</Nominal>.*<Name>(.*)</Name>.*<Value>(.*)</Value>.*</Valute>|sUS', $result, $m);

        foreach ($m['1'] as $k=>$v){
            if($v == "USD"){
                $settings = Yii::$app->settings->set('rub_rate', $m['4'][$k], 'main');

                if ($settings) {
                    var_dump('Ok');
                } else {
                    var_dump('Can\'t save');
                }
            } else if($v == "EUR") {
                $settings = Yii::$app->settings->set('rub_eur', $m['4'][$k], 'main');

                if ($settings) {
                    var_dump('Ok');
                } else {
                    var_dump('Can\'t save');
                }
            }
        }
    }
}
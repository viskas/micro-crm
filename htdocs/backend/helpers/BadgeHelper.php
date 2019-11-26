<?php

namespace backend\helpers;

use yii;
use common\models\ClientCalls;

class BadgeHelper
{
    public static function callsCount()
    {
        return ClientCalls::find()
            ->joinWith(['client'])
            ->where(['clients.user_id' => Yii::$app->user->identity->getId()])
            ->andWhere(['client_calls.status' => 0])
            ->count();
    }

    public static function missedCalls()
    {
        $count = 0;
        $now = new \DateTime();
        $now->setTime( 0, 0, 0 );
        $currentDate = date('Y-m-d');
        $currentUserId = Yii::$app->user->identity->getId();

        $calls = ClientCalls::find()
            ->joinWith(['client'])
            ->where(['clients.user_id' => $currentUserId])
            ->andWhere(['<=', 'DATE(date)', $currentDate])
            ->andWhere(['client_calls.status' => 0])
            ->orderBy('time')
            ->all();

        if ($calls && !empty($calls)) {
            foreach ($calls as $call) {
                $callDate = new \DateTime($call->date);
                $callDate->setTime( 0, 0, 0 );

                $date = strtotime($call->date . ' ' . $call->time .':00');
                $nowDate = time();

                if ($now->diff($callDate)->days !== 0 || $date <= $nowDate) {
                    $count += 1;
                }
            }
        }

        return $count;
    }
}
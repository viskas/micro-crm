<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\TgNotify;
use common\models\ClientCalls;
use Telegram\Bot\Api;

class TgController extends Controller
{
    public function actionIndex()
    {
        $telegramNotifications = TgNotify::find()->all();

        $currentDate = date('Y-m-d');

        if ($telegramNotifications) {
            foreach ($telegramNotifications as $notification) {
                $clientCalls = $this->clientCalls($notification->user_id, $currentDate);

                if ($clientCalls) {
                    foreach($clientCalls as $call) {
                        $now = new \DateTime();
                        $now->setTime( 0, 0, 0 );

                        $callDate = new \DateTime($call->date);
                        $callDate->setTime( 0, 0, 0 );

                        $date = strtotime($call->date . ' ' . $call->time .':00');
                        $nowDate = time();

                        if ($now->diff($callDate)->days !== 0 || $date <= $nowDate) {
                            $telegram = new Api(Yii::$app->params['telegram']['botToken']);

                            $text = "👉 ☎️ Пропущен звонок!\nЗайдите в систему и просмотрите детали.";
                            $telegram->sendMessage(['chat_id' => $notification->chat_id, 'text' => $text]);
                            break;
                        }
                    }
                }
            }

            var_dump('Complete');
            exit();
        }

        var_dump('Notifications not found');
    }

    private function clientCalls($userId, $currentDate)
    {
        return ClientCalls::find()
            ->joinWith(['client'])
            ->where(['clients.user_id' => $userId])
            ->andWhere(['<=', 'DATE(date)', $currentDate])
            ->andWhere(['client_calls.status' => 0])
            ->orderBy('time')
            ->all();
    }
}
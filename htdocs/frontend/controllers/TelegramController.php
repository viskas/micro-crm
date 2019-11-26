<?php
namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\web\Controller;
use Telegram\Bot\Api;
use common\models\TgNotify;

class TelegramController extends Controller
{
    public $enableCsrfValidation = false;

    protected $telegram;

    public function __construct($id, $module, $config = [])
    {
        $this->telegram = new Api(Yii::$app->params['telegram']['botToken']);

        parent::__construct($id, $module, $config);
    }

    public function actionInit()
    {
        $result = $this->telegram->getWebhookUpdates();

        return $this->webhookData($result);
    }

    protected function webhookData($data)
    {
        $command = isset($data["message"]["text"]) ? $data["message"]["text"] : '';
        $chat_id = isset($data["message"]["chat"]["id"]) ? $data["message"]["chat"]["id"] : '';

        if ($command) {
            switch ($command) {
                case "/start":
                    $text = "Авторизируйтесь (Формат: E-mail||Пароль)";
                    return $this->telegram->sendMessage(['chat_id' => $chat_id, 'text' => $text]);
                default:
                    return $this->auth($chat_id, $command);
            }
        }
    }

    private function secretWord($chat_id)
    {
        $tgNotify = TgNotify::findOne(['chat_id' => $chat_id]);

        if ($tgNotify) {
            return $this->telegram->sendMessage(['chat_id' => $chat_id, 'text' => 'Вы уже себя подтвердили и вам доступны уведомления.']);
        }

        if (!$tgNotify) {
            $model = new TgNotify();
            $model->chat_id = $chat_id;
            $model->save(false);

            return $this->telegram->sendMessage(['chat_id' => $chat_id, 'text' => 'Все верно! Теперь вам доступны уведомления.']);
        }
    }

    public function auth($chat_id, $command)
    {
        $email = null;
        $password = null;
        $credentials = explode("||", $command);

        if (isset($credentials[0]) && !empty($credentials[0])) {
            $email = trim($credentials[0]);
        }

        if (isset($credentials[1]) && !empty($credentials[1])) {
            $password = trim($credentials[1]);
        }

        if (!$email || !$password) {
            return $this->telegram->sendMessage(['chat_id' => $chat_id, 'text' => 'Не верно.']);
        }

        $user = User::findByEmail($email);

        $tgNotify = TgNotify::findOne(['chat_id' => $chat_id]);

        if ($user->validatePassword($password) && !$tgNotify) {
            $model = new TgNotify();
            $model->chat_id = $chat_id;
            $model->user_id = $user->id;
            $model->save(false);

            return $this->telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Привет, {$user->first_name}, теперь вам доступны уведомления."]);
        }

        return $this->telegram->sendMessage(['chat_id' => $chat_id, 'text' => 'Не верно.']);
    }
}
<?php

namespace common\modules\logger\model;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;

use common\models\User;

class ActionLog extends ActiveRecord
{
    const LOG_STATUS_SUCCESS    = 'success';
    const LOG_STATUS_INFO       = 'info';
    const LOG_STATUS_WARNING    = 'warning';
    const LOG_STATUS_ERROR      = 'error';

    public static function tableName()
    {
        return '{{%actionlog}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'time',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function add($status = null, $message = null, $uID = 0)
    {
        $model                  = Yii::createObject(__CLASS__);
        $model->user_id         = ((int)$uID !== 0) ? (int)$uID : (int)$model->getUserID();
        $model->user_remote     = $_SERVER['REMOTE_ADDR'];
        $model->action          = Yii::$app->requestedAction->id;
        $model->category        = Yii::$app->requestedAction->controller->id;
        $model->status          = $status;
        $model->message         = ($message !== null) ? $message : null;

        return $model->save();
    }

    public static function getUserID()
    {
        $user = Yii::$app->getUser();

        return $user && !$user->getIsGuest() ? $user->getId() : 0;
    }

    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('actionlog', 'ID'),
            'user_id'       => Yii::t('actionlog', 'Пользователь'),
            'user_remote'   => Yii::t('actionlog', 'IP адресс'),
            'time'          => Yii::t('actionlog', 'Время'),
            'action'        => Yii::t('actionlog', 'Action'),
            'category'      => Yii::t('actionlog', 'Controller'),
            'status'        => Yii::t('actionlog', 'Статус'),
            'message'       => Yii::t('actionlog', 'Действие'),
        ];
    }

    protected function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

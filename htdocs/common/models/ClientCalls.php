<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%client_calls}}".
 *
 * @property int $id
 * @property int $client_id
 * @property string $date
 * @property string $time
 * @property string $comment
 * @property int $status
 * @property string $created_at
 *
 * @property Clients $client
 */
class ClientCalls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%client_calls}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date', 'time'], 'required'],
            [['client_id', 'status'], 'integer'],
            [['date', 'created_at'], 'safe'],
            [['comment'], 'string'],
            [['time'], 'string', 'max' => 20],
            [['time'], 'existingCall'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Клиент',
            'date' => 'Дата',
            'time' => 'Время',
            'comment' => 'Заметка',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
        ];
    }

    public function existingCall($attribute, $params)
    {
        $clientCall = self::find()
            ->joinWith(['client'])
            ->where(['clients.user_id' => Yii::$app->user->identity->getId()])
            ->andWhere(['date' => date('Y-m-d', strtotime($this->date))])
            ->andWhere(['time' => $this->time])
            ->andWhere(['<>', 'client_calls.status', 1])
            ->one();

        if ($this->isNewRecord) {
            if ($clientCall) {
                $this->addError('time', 'На данное время уже есть звонок.');
            }
        } else {
            if ($this->id != $clientCall->id) {
                $this->addError('time', 'На данное время уже есть звонок.');
            }
        }

//        if ($clientCall) {
//            if (isset($this->id) && $this->id && $this->id != $clientCall->id) {
//                $this->addError('time', 'На данное время уже есть звонок.');
//            }
//        }
//            $this->addError('email', Yii::t('app', 'Такой email уже существует.'));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }
}

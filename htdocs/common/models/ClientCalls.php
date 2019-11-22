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
            [['date', 'time'], 'required'],
            [['client_id', 'status'], 'integer'],
            [['date', 'created_at'], 'safe'],
            [['comment'], 'string'],
            [['time'], 'string', 'max' => 20],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }
}

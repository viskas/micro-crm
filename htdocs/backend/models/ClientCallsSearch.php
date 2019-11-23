<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ClientCalls;


class ClientCallsSearch extends ClientCalls
{

    public function rules()
    {
        return [
            [['id', 'client_id', 'status'], 'integer'],
            [['date', 'time', 'comment'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ClientCalls::find()
            ->joinWith(['client']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30
            ],
            'sort'=> [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'client_calls.id' => $this->id,
            'client_calls.client_id' => $this->client_id,
            'client_calls.date' => $this->date,
            'client_calls.status' => $this->status,
            'client_calls.created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'client_calls.time', $this->time])
            ->andFilterWhere(['like', 'client_calls.comment', $this->comment]);

        $query->andWhere(['clients.user_id' => Yii::$app->user->identity->getId()]);

        return $dataProvider;
    }
}

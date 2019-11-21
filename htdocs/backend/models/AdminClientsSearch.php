<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Clients;


class AdminClientsSearch extends Clients
{
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['platform', 'account_number', 'phone_number', 'additional_phone_number', 'first_name', 'last_name', 'patronymic', 'birthday', 'address', 'skype', 'team_viewer', 'status', 'additional_info'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Clients::find()
            ->joinWith(['user']);

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
            'clients.id' => $this->id,
            'user_id' => $this->user_id,
            'birthday' => $this->birthday,
            'clients.created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'platform', $this->platform])
            ->andFilterWhere(['like', 'account_number', $this->account_number])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'additional_phone_number', $this->additional_phone_number])
            ->andFilterWhere(['like', 'clients.first_name', $this->first_name])
            ->orFilterWhere(['like', 'clients.last_name', $this->first_name])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'skype', $this->skype])
            ->andFilterWhere(['like', 'team_viewer', $this->team_viewer])
            ->andFilterWhere(['like', 'clients.status', $this->status])
            ->andFilterWhere(['like', 'additional_info', $this->additional_info]);

        return $dataProvider;
    }
}

<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Audio;

/**
 * AudioSearch represents the model behind the search form about `backend\models\Audio`.
 */
class AudioSearch extends Audio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'description', 'user_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $userId = Yii::$app->user->identity->getId();

        $role = AuthAssignment::find()
            ->where(['user_id' => $userId])
            ->one();

        $query = Audio::find()
            ->joinWith(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'audio.id' => $this->id,
            'audio.created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'audio.title', $this->title])
            ->andFilterWhere(['like', 'audio.description', $this->description])
            ->andFilterWhere(['like', 'user.first_name', $this->user_id]);

        if ($role->item_name != 'Администратор') {
            $query->andWhere(['user_id' => $userId]);
        }

        return $dataProvider;
    }
}

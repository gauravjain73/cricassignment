<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Teams;

/**
 * TeamsSearch represents the model behind the search form about `common\models\Teams`.
 */
class TeamsSearch extends Teams
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'team_status'], 'integer'],
            [['team_identifier', 'team_name', 'team_logo', 'team_country', 'team_created_at', 'team_updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = Teams::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'team_status' => $this->team_status,
            'team_created_at' => $this->team_created_at,
            'team_updated_at' => $this->team_updated_at,
        ]);

        $query->andFilterWhere(['like', 'team_identifier', $this->team_identifier])
            ->andFilterWhere(['like', 'team_name', $this->team_name])
            ->andFilterWhere(['like', 'team_logo', $this->team_logo])
            ->andFilterWhere(['like', 'team_country', $this->team_country]);

        return $dataProvider;
    }
}

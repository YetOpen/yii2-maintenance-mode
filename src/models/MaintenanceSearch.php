<?php

namespace brussens\maintenance\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use brussens\maintenance\models\Maintenance;

/**
 * MaintenanceSearch represents the model behind the search form of `brussens\maintenance\models\Maintenance`.
 */
class MaintenanceSearch extends Maintenance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['date', 'time_start', 'time_end'], 'safe'],
            [['date'], 'filter', 'filter' => [$this, 'formatDate'], 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Maintenance::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->enableMultiSort = true;
        $dataProvider->sort->defaultOrder = ['date' => SORT_DESC, 'time_start' => SORT_DESC];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);
        $query->andFilterWhere(['like', 'time_start', "$this->time_start%", false]);
        $query->andFilterWhere(['like', 'time_end', "$this->time_end%", false]);

        return $dataProvider;
    }
}

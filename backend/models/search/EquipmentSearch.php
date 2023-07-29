<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Equipment;

/**
 * EquipmentSearch represents the model behind the search form of `common\models\Equipment`.
 */
class EquipmentSearch extends Equipment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'make_id', 'equipmodel_id', 'location_id', 'status', 'condition'], 'integer'],
            [['code', 'name', 'serial_number', 'tag_number', 'details', 'date_of_delivery'], 'safe'],
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
        $query = Equipment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'make_id' => $this->make_id,
            'equipmodel_id' => $this->equipmodel_id,
            'date_of_delivery' => $this->date_of_delivery,
            'location_id' => $this->location_id,
            'status' => $this->status,
            'condition' => $this->condition,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'tag_number', $this->tag_number])
            ->andFilterWhere(['like', 'details', $this->details]);

        return $dataProvider;
    }
}

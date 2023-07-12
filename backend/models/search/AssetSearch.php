<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Asset;

/**
 * AssetSearch represents the model behind the search form of `common\models\Asset`.
 */
class AssetSearch extends Asset
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'date_of_delivery', 'status', 'condition'], 'integer'],
            [['code', 'category', 'make', 'model', 'name', 'serial_number', 'tag_number', 'details', 'location'], 'safe'],
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
        $query = Asset::find();

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
            'date_of_delivery' => $this->date_of_delivery,
            'status' => $this->status,
            'condition' => $this->condition,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'make', $this->make])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'tag_number', $this->tag_number])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'location', $this->location]);

        return $dataProvider;
    }
}

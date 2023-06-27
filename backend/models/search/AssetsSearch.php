<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Assets;

/**
 * AssetsSearch represents the model behind the search form of `common\models\Assets`.
 */
class AssetsSearch extends Assets
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'asset_master_id', 'location_id', 'storage', 'ram', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['model', 'serial_number', 'tag_number', 'accessories', 'condition', 'location'], 'safe'],
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
        $query = Assets::find();

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
            'asset_master_id' => $this->asset_master_id,
            'location_id' => $this->location_id,
            'storage' => $this->storage,
            'ram' => $this->ram,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'tag_number', $this->tag_number])
            ->andFilterWhere(['like', 'accessories', $this->accessories])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'location', $this->location]);

        return $dataProvider;
    }
}

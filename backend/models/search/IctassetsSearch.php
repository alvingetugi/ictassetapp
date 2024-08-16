<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ictassets;

/**
 * IctassetsSearch represents the model behind the search form of `common\models\Ictassets`.
 */
class IctassetsSearch extends Ictassets
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoryID', 'makeID', 'modelID', 'storageID', 'ramID', 'osID', 'locationID', 'assetstatus', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code', 'name', 'tag_number', 'assetcondition'], 'safe'],
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
        $query = Ictassets::find();

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
            'categoryID' => $this->categoryID,
            'makeID' => $this->makeID,
            'modelID' => $this->modelID,
            'storageID' => $this->storageID,
            'ramID' => $this->ramID,
            'osID' => $this->osID,
            'locationID' => $this->locationID,
            'assetstatus' => $this->assetstatus,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'tag_number', $this->tag_number])
            ->andFilterWhere(['like', 'assetcondition', $this->assetcondition]);

        return $dataProvider;
    }
}

<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Assetmodels;

/**
 * AssetmodelsSearch represents the model behind the search form of `common\models\Assetmodels`.
 */
class AssetmodelsSearch extends Assetmodels
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['code', 'name', 'categoryID', 'makeID'], 'safe'],
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
        $query = Assetmodels::find()->joinWith(['category'])->joinWith(['make']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['categoryID'] = [
            'asc' => ['categoryID' => SORT_ASC],
            'desc' => ['categoryID' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['makeID'] = [
            'asc' => ['makeID' => SORT_ASC],
            'desc' => ['makeID' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'categoryID' => $this->categoryID,
            // 'makeID' => $this->makeID,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'assetcategories.name', $this->categoryID])
            ->andFilterWhere(['like', 'assetmakes.name', $this->makeID]);

        return $dataProvider;
    }
}

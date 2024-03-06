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
            [['id', 'categoryID', 'makeID', 'storage', 'ram', 'locationID', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code', 'name', 'tag_number', 'operating_system', 'date_of_delivery', 'assetstatus', 'assetcondition','modelID'], 'safe'],
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
    public function search($params, $pageSize = 10)
    {
        $query = Ictassets::find()->joinWith(['category'])->joinWith(['make'])->joinWith(['model']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,  // no pagination if it is 0
            ],
        ]);

        $dataProvider->sort->attributes['categoryID'] = [
            'asc' => ['categoryID' => SORT_ASC],
            'desc' => ['categoryID' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['makeID'] = [
            'asc' => ['makeID' => SORT_ASC],
            'desc' => ['makeID' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['modelID'] = [
            'asc' => ['modelID' => SORT_ASC],
            'desc' => ['modelID' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['name'] = [
            'asc' => ['name' => SORT_ASC],
            'desc' => ['name' => SORT_DESC],
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
            // 'modelID' => $this->modelID,
            // 'name' => $this->name,
            'storage' => $this->storage,
            'ram' => $this->ram,
            'date_of_delivery' => $this->date_of_delivery,
            'locationID' => $this->locationID,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'assetcategories.name', $this->categoryID])
            ->andFilterWhere(['like', 'assetmakes.name', $this->makeID])
            ->andFilterWhere(['like', 'assetmodels.name', $this->modelID])
            ->andFilterWhere(['like', 'ictassets.name', $this->name])
            ->andFilterWhere(['like', 'tag_number', $this->tag_number])
            ->andFilterWhere(['like', 'operating_system', $this->operating_system])
            ->andFilterWhere(['like', 'assetstatus', $this->assetstatus])
            ->andFilterWhere(['like', 'assetcondition', $this->assetcondition]);

        return $dataProvider;
    }
}

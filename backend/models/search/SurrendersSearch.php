<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Surrenders;

/**
 * SurrendersSearch represents the model behind the search form of `common\models\Surrenders`.
 */
class SurrendersSearch extends Surrenders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoryID', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code', 'surrenderdate', 'comments', 'modelID', 'serialnumber','userID'], 'safe'],
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
        $query = Surrenders::find()->joinWith(['model'])->joinWith(['serials'])->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['modelID'] = [
            'asc' => ['modelID' => SORT_ASC],
            'desc' => ['modelID' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['serialnumber'] = [
            'asc' => ['serialnumber' => SORT_ASC],
            'desc' => ['serialnumber' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['userID'] = [
            'asc' => ['userID' => SORT_ASC],
            'desc' => ['userID' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'surrenderdate' => $this->surrenderdate,
            'categoryID' => $this->categoryID,
            // 'modelID' => $this->modelID,
            // 'serialnumber' => $this->serialnumber,
            // 'userID' => $this->userID,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'assetmodels.name', $this->modelID])
            ->andFilterWhere(['like', 'ictassets.name', $this->serialnumber])
            ->andFilterWhere(['like', 'user.username', $this->userID])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}

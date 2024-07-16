<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Rapcommitments;

/**
 * RapcommitmentsSearch represents the model behind the search form of `common\models\Rapcommitments`.
 */
class RapcommitmentsSearch extends Rapcommitments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rapID'], 'integer'],
            [['date', 'comments', 'document'], 'safe'],
            [['expectedamount'], 'number'],
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
        $query = Rapcommitments::find();

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
            'rapID' => $this->rapID,
            'date' => $this->date,
            'expectedamount' => $this->expectedamount,
        ]);

        $query->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'document', $this->document]);

        return $dataProvider;
    }
}

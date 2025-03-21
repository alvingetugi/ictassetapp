<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Rappayments;

/**
 * RappaymentsSearch represents the model behind the search form of `common\models\Rappayments`.
 */
class RappaymentsSearch extends Rappayments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rapID', 'scheduleID'], 'integer'],
            [['name', 'paymentdate', 'comments', 'proof'], 'safe'],
            [['amount'], 'number'],
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
        $query = Rappayments::find();

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
            'scheduleID' => $this->scheduleID,
            'paymentdate' => $this->paymentdate,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'proof', $this->proof]);

        return $dataProvider;
    }
}

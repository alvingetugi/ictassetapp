<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Maintenanceout;

/**
 * MaintenanceoutSearch represents the model behind the search form of `common\models\Maintenanceout`.
 */
class MaintenanceoutSearch extends Maintenanceout
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoryID', 'modelID', 'serialnumber', 'accessorylistID', 'userID', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code', 'outwarddate', 'comments'], 'safe'],
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
        $query = Maintenanceout::find();

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
            'outwarddate' => $this->outwarddate,
            'categoryID' => $this->categoryID,
            'modelID' => $this->modelID,
            'serialnumber' => $this->serialnumber,
            'accessorylistID' => $this->accessorylistID,
            'userID' => $this->userID,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}

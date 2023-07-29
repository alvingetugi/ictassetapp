<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Equipment]].
 *
 * @see \common\models\Equipment
 */
class EquipmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Equipment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Equipment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

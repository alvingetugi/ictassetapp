<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Operatingsystem]].
 *
 * @see \common\models\Operatingsystem
 */
class OperatingsystemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Operatingsystem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Operatingsystem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

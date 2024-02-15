<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Issuances]].
 *
 * @see \common\models\Issuances
 */
class IssuancesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Issuances[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Issuances|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

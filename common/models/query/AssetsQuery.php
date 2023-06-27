<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Assets]].
 *
 * @see \common\models\Assets
 */
class AssetsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Assets[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Assets|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Assetmaster]].
 *
 * @see \common\models\Assetmaster
 */
class AssetmasterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Assetmaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Assetmaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

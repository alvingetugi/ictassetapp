<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Authitemchild]].
 *
 * @see \common\models\Authitemchild
 */
class AuthitemchildQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Authitemchild[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Authitemchild|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

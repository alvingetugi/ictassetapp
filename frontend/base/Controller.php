<?php

namespace frontend\base;

use common\models\CartItem;

/**
 * Class Controller
 *
 * @author agetugi <email>
 * @package frontend\base
 */

 class Controller extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        // Fetches number of single products added to cart and not the sum of quantities
        // $this->view->params['cartItemCount'] = CartItem::find()->userId(\Yii::$app->user->id)->count();
        // return parent::beforeAction($action);

        // Fetches total number of products added to cart
        $this->view->params['cartItemCount'] = CartItem::findBySql(
            "Select SUM(quantity) FROM cart_items WHERE created_by = :userId", ['userId' => \Yii::$app->user->id]
        )->scalar();
        return parent::beforeAction($action);
    }
}
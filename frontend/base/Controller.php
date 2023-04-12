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
        if (\Yii::$app->user->isGuest) {
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            $sum = 0;
            foreach ($cartItems as $cartItem) {
                $sum += $cartItem['quantity'];
            }
        } else {

            //Fetches number of single products added to cart and not the sum of quantities.
            // $sum = CartItem::find()->userId(\Yii::$app->user->id)->count();

            // Fetches total number of quantities added to cart
            $sum = CartItem::findBySql(
                "Select SUM(quantity) FROM cart_items WHERE created_by = :userId",
                ['userId' => \Yii::$app->user->id]
            )->scalar();
        }
        $this->view->params['cartItemCount'] = $sum; //assign the sum variable to the cart item count
        return parent::beforeAction($action);
    }
}
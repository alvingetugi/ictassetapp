<?php

namespace frontend\controllers;

use common\models\CartItem;
use common\models\Order;
use common\models\Product;
use common\models\OrderAddress;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use Yii;

/**
 * Class CartController
 *
 * @author agetugi <email>
 * @package frontend\controllers
 */

class CartController extends \frontend\base\Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::class,
                'only' => ['add'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST', 'DELETE'],
                ]
            ]
        ];
    }
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            //get the items from session
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);

        } else {
            //get the items from database
            $cartItems = CartItem::getItemsForUser(currUserId());
        }

        return $this->render('index', [
            'items' => $cartItems
        ]);
    }

    public function actionAdd()
    {
        $id = \yii::$app->request->post('id'); //get id of the product
        $product = Product::find()->id($id)->published()->one(); //find one product which has the id and is published
        if (!$product) {
            throw new NotFoundHttpException("Product does not exist");
        }

        if (\Yii::$app->user->isGuest) {
            // Save in session
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []); //find item with product id
            $found = false; //keep track if item exists with product id and quantity
            foreach ($cartItems as &$item) {
                if ($item['id'] == $id) {
                    $item['quantity']++; //comment this to prevent adding quantities in the cart
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $cartItem = [
                    'id' => $id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => 1,
                    'total_price' => $product->price
                ];
                $cartItems[] = $cartItem; //create new cart item and adds it into an array
            }

            \Yii::$app->session->set(CartItem::SESSION_KEY, $cartItems); //set cart item into session
        } else {
            $userId = \Yii::$app->user->id;
            $cartItem = CartItem::find()->userId($userId)->productId($id)->one(); //find cart item for a logged in user
            if ($cartItem) {
                $cartItem->quantity++;
            } else {
                $cartItem = new CartItem();
                $cartItem->product_id = $id;
                $cartItem->created_by = \Yii::$app->user->id;
                $cartItem->quantity = 1;
            }
            if ($cartItem->save()) {
                return [
                    'success' => true
                ];
            } else {
                return [
                    'success' => false,
                    'errors' => $cartItem->errors
                ];
            }

        }
    }

    public function actionDelete($id)
    {
        if (isGuest()) {
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            foreach ($cartItems as $i => $cartItem) {
                if ($cartItem['id'] == $id) {
                    array_splice($cartItems, $i, 1);
                    break;
                }
            }
            \Yii::$app->session->set(CartItem::SESSION_KEY, $cartItems);
        } else {
            CartItem::deleteAll(['product_id' => $id, 'created_by' => currUserId()]);
        }
        return $this->redirect(['index']);
    }
    public function actionChangeQuantity()
    {
        $id = \yii::$app->request->post('id'); //get id of the product
        $product = Product::find()->id($id)->published()->one(); //find one product which has the id and is published
        if (!$product) {
            throw new NotFoundHttpException("Product does not exist");
        }
        $quantity = \Yii::$app->request->post('quantity');
        if (isGuest()) {
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            foreach ($cartItems as &$cartItem) {
                if ($cartItem['id'] === $id) {
                    $cartItem['quantity'] = $quantity;
                    break;
                }
            }
            \Yii::$app->session->set(CartItem::SESSION_KEY, $cartItems);
        } else {
            $cartItem = CartItem::find()->userId(currUserId())->productId($id)->one();
            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }
        return CartItem::getTotalQuantityForUser(currUserId());
    }

    public function actionCheckout()
    {
   
        $order = new Order();
        $orderAddress = new OrderAddress();

        if (!isGuest()) {
            /** @var \common\models\User $user */
            $user = Yii::$app->user->identity;
            $userAddress = $user->getAddress();

            $order->firstname = $user->firstname;
            $order->lastname = $user->lastname;
            $order->email = $user->email;
            $order->status = Order::STATUS_DRAFT;
            
            $orderAddress = new OrderAddress();
            $orderAddress->address = $userAddress->address;
            $orderAddress->city = $userAddress->city;
            $orderAddress->state = $userAddress->state;
            $orderAddress->country = $userAddress->country;
            $orderAddress->zipcode = $userAddress->zipcode;
            $cartItems = CartItem::getItemsForUser(currUserId());
        } else {
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
        }

        $productQuantity = CartItem::getTotalQuantityForUser(currUserId());
        $totalPrice = CartItem::getTotalPriceForUser(currUserId());

        return $this->render('checkout', [
            'order' => $order,
            'orderAddress' => $orderAddress,
            'cartItems' => $cartItems,
            'productQuantity' => $productQuantity,
            'totalPrice' => $totalPrice
        ]);
        
    }
}
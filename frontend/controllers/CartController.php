<?php

namespace frontend\controllers;

use common\models\CartItem;
use common\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;

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
        if (\Yii::$app->user->isGuest){
            //get the items from session
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);

        } else {
            //get the items from database
            $cartItems = CartItem::findBySql("
                            SELECT 
                                c.product_id as id, 
                                p.image, 
                                p.name, 
                                p.price, 
                                c.quantity, 
                                p.price*c.quantity as total_price
                            FROM cart_items c
                                    LEFT JOIN products p ON p.id = c.product_id
                            WHERE c.created_by = :userId", ['userId' => \Yii::$app->user->id])
            ->asArray()
            ->all();
        }

        return $this->render('index', [
            'items' => $cartItems
        ]);
    }

    public function actionAdd()
    {
        $id = \yii::$app->request->post('id'); //get id of the product
        $product = Product::find()->id($id)->published()->one(); //find one product which has the id and is published
        if (!$product){
            throw new NotFoundHttpException("Product does not exist");
        }

        if (\Yii::$app->user->isGuest){
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
            if ($cartItem){
                $cartItem->quantity++;
            } else {
                $cartItem = new CartItem();
                $cartItem->product_id = $id;
                $cartItem->created_by = \Yii::$app->user->id;
                $cartItem->quantity = 1;
            }
            if ($cartItem->save()){
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
        if (isGuest()){
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            foreach ($cartItems as $i => $cartItem){
                if ($cartItem['id'] == $id){
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
 }
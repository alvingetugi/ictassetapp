<?php
/** User: Alvin ...*/
/** @var \common\models\Order $order */
/** @var \common\models\OrderAddress $orderAddress */
/** @var array $cartItems*/
/** @var int $productQuantity*/
/** @var float $totalPrice*/

use yii\bootstrap5\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'action' => [''],
]); ?>

<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                Staff Details
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($order, 'firstname')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($order, 'lastname')->textInput(['autofocus' => true]) ?>
                    </div>
                </div>

                <?= $form->field($order, 'email')->textInput(['autofocus' => true]) ?>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Staff Location
            </div>
            <div class="card-body">
                <?= $form->field($orderAddress, 'address') ?>
                <?= $form->field($orderAddress, 'city') ?>
                <?= $form->field($orderAddress, 'state') ?>
                <?= $form->field($orderAddress, 'country') ?>
                <?= $form->field($orderAddress, 'zipcode') ?>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card">
            <div class="card-header">
                Asset Bag Summary
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td colspan="2"><?php echo $productQuantity ?> Asset(s) </td>
                    </tr>
                    <tr>
                        <td>Total Price</td>
                        <td class="text-right">
                            <?php echo Yii::$app->formatter->asCurrency($totalPrice) ?>
                        </td>
                    </tr>
                </table>

                <p class="text-end mt-3">
                    <button class="btn btn-success">Issue</button>
                </p>

            </div>
        </div>
    </div>

</div>



<?php ActiveForm::end(); ?>
<?php

use yii\bootstrap5\ActiveForm;

/** @var \common\models\UserAddress $userAddress*/
/** @var \yii\web\View $this*/

?>

<?php if (isset($success) && $success): ?>
<div class="alert alert-success">
    Your address was updated successfully!
</div>
<?php endif ?>

<?php $addressForm = ActiveForm::begin([
    'action' => ['/profile/update-address/'],
    'options' => [
        'data-Pjax' => 1
    ]
]); ?>
<?= $addressForm->field($userAddress, 'address') ?>
<?= $addressForm->field($userAddress, 'city') ?>
<?= $addressForm->field($userAddress, 'state') ?>
<?= $addressForm->field($userAddress, 'country') ?>
<?= $addressForm->field($userAddress, 'zipcode') ?>
<button class="btn btn-primary">Update</button>

<?php ActiveForm::end(); ?>
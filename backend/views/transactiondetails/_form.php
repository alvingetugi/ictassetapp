<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Transactiondetails $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transactiondetails-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trans_id')->textInput() ?>

    <?= $form->field($model, 'asset_id')->textInput() ?>

    <?= $form->field($model, 'details')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

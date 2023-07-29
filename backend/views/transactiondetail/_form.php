<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Transactiondetail $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transactiondetail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'trans_id')->textInput() ?>

    <?= $form->field($model, 'equipment_id')->textInput() ?>

    <?= $form->field($model, 'details')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

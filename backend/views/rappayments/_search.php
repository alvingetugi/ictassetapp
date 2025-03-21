<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\RappaymentsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rappayments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rapID') ?>

    <?= $form->field($model, 'scheduleID') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'paymentdate') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'proof') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

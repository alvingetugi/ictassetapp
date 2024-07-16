<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\PlanledgerSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="planledger-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rapID') ?>

    <?= $form->field($model, 'debit') ?>

    <?= $form->field($model, 'credit') ?>

    <?= $form->field($model, 'runningbalance') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'duedate') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

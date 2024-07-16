<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\RemedialactionplansSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="remedialactionplans-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rapref') ?>

    <?= $form->field($model, 'schemeID') ?>

    <?= $form->field($model, 'raptype') ?>

    <?= $form->field($model, 'deficit') ?>

    <?php // echo $form->field($model, 'planstart') ?>

    <?php // echo $form->field($model, 'frequency') ?>

    <?php // echo $form->field($model, 'installmentamount') ?>

    <?php // echo $form->field($model, 'planend') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'runningbalance') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

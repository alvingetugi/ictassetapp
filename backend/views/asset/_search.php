<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\AssetSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asset-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'make') ?>

    <?= $form->field($model, 'model') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'serial_number') ?>

    <?php // echo $form->field($model, 'tag_number') ?>

    <?php // echo $form->field($model, 'details') ?>

    <?php // echo $form->field($model, 'date_of_delivery') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'condition') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

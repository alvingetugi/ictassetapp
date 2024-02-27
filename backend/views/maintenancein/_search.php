<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\MaintenanceinSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="maintenancein-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'inwarddate') ?>

    <?= $form->field($model, 'categoryID') ?>

    <?= $form->field($model, 'modelID') ?>

    <?php // echo $form->field($model, 'serialnumber') ?>

    <?php // echo $form->field($model, 'userID') ?>

    <?php // echo $form->field($model, 'comments') ?>

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

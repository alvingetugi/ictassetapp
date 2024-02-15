<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\IctassetsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ictassets-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'categoryID') ?>

    <?= $form->field($model, 'makeID') ?>

    <?= $form->field($model, 'modelID') ?>

    <?php // echo $form->field($model, 'serialnumber') ?>

    <?php // echo $form->field($model, 'tag_number') ?>

    <?php // echo $form->field($model, 'storage') ?>

    <?php // echo $form->field($model, 'ram') ?>

    <?php // echo $form->field($model, 'operating_system') ?>

    <?php // echo $form->field($model, 'date_of_delivery') ?>

    <?php // echo $form->field($model, 'locationID') ?>

    <?php // echo $form->field($model, 'assetstatus') ?>

    <?php // echo $form->field($model, 'assetcondition') ?>

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

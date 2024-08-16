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

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'tag_number') ?>

    <?php // echo $form->field($model, 'storageID') ?>

    <?php // echo $form->field($model, 'ramID') ?>

    <?php // echo $form->field($model, 'osID') ?>

    <?php // echo $form->field($model, 'locationID') ?>

    <?php // echo $form->field($model, 'assetstatus') ?>

    <?php // echo $form->field($model, 'assetcondition') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::label('Page Size') ?>
        <?= Html::dropDownList('pageSize', $pageSize, 
            [0 => 'ALL', 10 => '10', 20 => '20', 50 => '50'],
            ['class' => 'form-control']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

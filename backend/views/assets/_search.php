<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\AssetsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assets-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'asset_master_id') ?>

    <?= $form->field($model, 'location_id') ?>

    <?= $form->field($model, 'serial_number') ?>

    <?php // echo $form->field($model, 'tag_number') ?>

    <?php // echo $form->field($model, 'storage') ?>

    <?php // echo $form->field($model, 'ram') ?>

    <?php // echo $form->field($model, 'accessories') ?>

    <?php // echo $form->field($model, 'condition') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'status') ?>

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

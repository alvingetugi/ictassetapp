<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Depreciation $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="depreciation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'assetID')->textInput() ?>

    <?= $form->field($model, 'purchase_value')->textInput() ?>

    <?= $form->field($model, 'current_value')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Assetaccessories $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assetaccessories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'accessorylistID')->textInput() ?>

    <?= $form->field($model, 'assetID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

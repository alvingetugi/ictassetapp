<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Maintenanceout $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="maintenanceout-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outwarddate')->textInput() ?>

    <?= $form->field($model, 'categoryID')->textInput() ?>

    <?= $form->field($model, 'modelID')->textInput() ?>

    <?= $form->field($model, 'serialnumber')->textInput() ?>

    <?= $form->field($model, 'userID')->textInput() ?>

    <?= $form->field($model, 'comments')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

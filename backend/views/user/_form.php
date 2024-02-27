<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'status')->textInput(['readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
   
    <?= $form->field($model, 'status')->radioList([0 => 'Deleted', 9 => 'Inactive', 10 => 'Active']) ?>

    <?= $form->field($model, 'firstname')->textInput([]) ?>

    <?= $form->field($model, 'lastname')->textInput([]) ?>

    <?= $form->field($model, 'department')->dropDownList(ArrayHelper::map(\common\models\Departments::find()->all(),'id','name'),['prompt'=>'Select']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

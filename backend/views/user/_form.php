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

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
   
    <?= $form->field($model, 'status')->radioList([0 => 'Deleted', 9 => 'Inactive', 10 => 'Active']) ?>

    <?= $form->field($model, 'firstname')->textInput([]) ?>

    <?= $form->field($model, 'lastname')->textInput([]) ?>

    <?= $form->field($model, 'department')->dropDownList([1 => 'Finance and Accounts', 
                                                            2 => 'Internal Audit and Risk Assurance', 
                                                            3 => 'Corporation Secretary and Legal Services', 
                                                            4 => 'Information and Communication Technology', 
                                                            5 => 'Market Conduct and Industry Development', 
                                                            6 => 'Supervision', 
                                                            7 => 'Corporate Communications', 
                                                            8 => 'Procurement and Supply Chain', 
                                                            9 => 'Human Resource and Administration', 
                                                            10 => 'Research, Strategy and Planning', 
                                                            11 => 'Executive', 
                                                            12 => 'Management Representative', 
                                                            13 => 'Tribunal', 
                                                            14 => 'Board']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

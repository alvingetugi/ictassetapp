<?php

use common\models\Rap;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Rapschedules $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rapschedules-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rapID')->dropDownList(
                Rap::getRaps(),
                ['prompt' => 'Select RAP']
            ) ?>

    <?= $form->field($model, 'name')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'duedate')->widget(\kartik\date\DatePicker::classname(), [
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]); ?>

    <?= $form->field($model, 'expectedamount')->textInput([
        'maxlength' => true,
        'type' => 'number',
        'step' => '0.01'
    ]) ?>

    <?= $form->field($model, 'comments')->textarea(['maxlength' => true, 'rows'=> 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Rappayments $model */
/** @var yii\widgets\ActiveForm $form */

// echo '<pre>';
// print_r($name);
// exit;
?>

<div class="rappayments-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'rapID')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($raps, 'id', function ($model) {
                return $model['scheme_name'] . ' - ' . $model['rap_amount'];
            }),
        'options' => ['placeholder' => '--SELECT--', 'data-validation' => 'required'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'date')->widget(\kartik\date\DatePicker::classname(), [
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]); ?>

    <?= $form->field($model, 'amount')->textInput([
        'maxlength' => true,
        'type' => 'number',
        'step' => '0.01'
    ]) ?>

    <?= $form->field($model, 'comments')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymentfile', [
        'template' => '
                <div class="custom-file">
                    {input}
                    {label}
                    {error}
                </div>
            ',
        'labelOptions' => ['class' => 'custom-file-label'],
        'inputOptions' => ['class' => 'custom-file-input']
    ])->textInput(['type' => 'file']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

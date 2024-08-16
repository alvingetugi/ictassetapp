<?php

use common\models\Rap;
use common\models\Rapcommitments;
use common\models\Rapschedules;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Rappayments $model */
/** @var yii\widgets\ActiveForm $form */

// echo '<pre>';
// print_r($name);
// exit;
?>

<div class="rappayments-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'rapID')->dropDownList(Rap::getRaps(),
        ['prompt' => 'Select RAP', 'id' => 'rap-id']) ?>

    <?= $form->field($model, 'scheduleID')->widget(DepDrop::classname(), [
            'data' => Rapschedules::getSchedulesList($model->scheduleID),
            'options' => ['id' => 'schedule-id', 'prompt' => 'Select Schedule'],
            'pluginOptions' => [
                'depends' => ['rap-id'],
                'placeholder' => 'Select Schedule',
                'url' => Url::to(['/rappayments/schedules']) //Url::to(['/controller/action'])
            ]
        ]); ?>

    <?= $form->field($model, 'name')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'paymentdate')->widget(\kartik\date\DatePicker::classname(), [
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

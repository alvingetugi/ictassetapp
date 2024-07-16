<?php

use common\models\Raptypes;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Rap $model */
/** @var yii\widgets\ActiveForm $form */

// echo '<pre>';
// print_r($schemes);
// exit;
?>


<div class="rap-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col">
        <?= $form->field($model, 'typeID')->dropDownList(
		        ArrayHelper::map(Raptypes::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
		        ['prompt'=>'Select Category']                          // options
		    ); ?>
        </div>
        <div class="col">
        <?= $form->field($model, 'schemeID')->label('Scheme')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($schemes, 'id', function ($model) {
                return $model->ref . ' - ' . $model->name;
            }),
                'options' => ['placeholder' => '--SELECT--', 'data-validation' => 'required'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        
    </div>

    <?= $form->field($model, 'amount')->textInput([
                'maxlength' => true,
                'type' => 'number',
                'step' => '0.01'
            ]) ?>

    <div class="row">
        <div class="col">

            <?= $form->field($model, 'start')->widget(\kartik\date\DatePicker::classname(), [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]); ?>
        </div>

        <div class="col">
            <?= $form->field($model, 'end')->widget(\kartik\date\DatePicker::classname(), [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]); ?>

        </div>
    </div>

    <?= $form->field($model, 'status')->radioList([1 => 'In Progress', 0 => 'Inactive']) ?>

    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
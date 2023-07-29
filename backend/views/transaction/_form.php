<?php

use common\models\Equipment;
use common\models\Location;
use common\models\Transactiontype;
use dosamigos\ckeditor\CKEditor;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Transaction $model */
/** @var yii\widgets\ActiveForm $form */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-detail").each(function(index) {
        jQuery(this).html("Detail: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-detail").each(function(index) {
        jQuery(this).html("Detail: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'date')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-md-4">
            <?= $form->field($model, 'transaction_type')->dropDownList(
                ArrayHelper::map(Transactiontype::find()->all(), 'id', 'type'),
                // Flat array ('id'=>'label')
                ['prompt' => 'Select Transaction Type'] // options
            ); ?>
        </div>
        <div class="col-sm-8 col-md-4">
            <?= $form->field($model, 'location_id')->dropDownList(
                ArrayHelper::map(Location::find()->all(), 'id', 'name'),
                // Flat array ('id'=>'label')
                ['prompt' => 'Select Location'] // options
            ); ?>
        </div>
        <div class="col-sm-8 col-md-4">
            <?= $form->field($model, 'staff')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="fa fa-envelope"></i> Details</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsTransactionDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'equipment_id',
                    'details',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsTransactionDetail as $i => $modelTransactionDetail): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Detail:<?= ($i + 1) ?></h3>
                        <div class="float-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$modelTransactionDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelTransactionDetail, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-8 col-md-4">
                            <?= $form->field($modelTransactionDetail, "[{$i}]equipment_id")->dropDownList(
                                        ArrayHelper::map(Equipment::find()->all(), 'id', 'name'),
                                        // Flat array ('id'=>'label')
                                        ['prompt' => 'Equipment'] // options
                                    ); ?>
                            </div>
                            <div class="col-sm-8">
                                    <?= $form->field($modelTransactionDetail, "[{$i}]details")->widget(CKEditor::className(), [
                                        'options' => ['rows' => 6],
                                        'preset' => 'basic'
                                    ]) ?>
                                </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($modelTransactionDetail->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
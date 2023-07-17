<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/** @var yii\web\View $this */
/** @var common\models\Transactions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transactions-form">

    <?php $form = ActiveForm::begin(['id' => 'transactions-form']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'date')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'transaction_type')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'details')->textInput() ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-th-list"></i> Transaction Details</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',  // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items',          // required: css class selector
                'widgetItem' => '.item',                     // required: css class
                'limit' => 999,                                // the maximum times, an element can be cloned (default 999)
                'min' => 1,                                  // 0 or 1 (default 1)
                'insertButton' => '.add-item',               // css class
                'deleteButton' => '.remove-item',            // css class
                'model' => $modelsTransactionDetails[0],
                'formId' => 'transactions-form',
                'formFields' => [
                    'trans_id',
                    'item_id',
                    'quantity',
                    'remarks',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsTransactionDetails as $i => $modelsTransactionDetail): ?>
                <div class="item row">
                    <?php
                        // necessary for update action.
                        if (! $modelsTransactionDetail->isNewRecord) {
                            echo Html::activeHiddenInput($detail, "[{$i}]id");
                        }
                    ?>
                    <div class="col-sm-8 col-md-4">
                        <?= $form->field($modelsTransactionDetail, "[{$i}]trans_id")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-4 col-md-2">
                        <?= $form->field($modelsTransactionDetail, "[{$i}]asset_id")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-10 col-md-5">
                    	<?= $form->field($modelsTransactionDetail, "[{$i}]details")->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-2 col-md-1 item-action">
                    	<div class="pull-right">
	                        <button type="button" class="add-item btn btn-success btn-xs">
	                        	<i class="glyphicon glyphicon-plus"></i></button> 
	                        <button type="button" class="remove-item btn btn-danger btn-xs">
	                        	<i class="glyphicon glyphicon-minus"></i></button>
                    	</div>
                    </div>
                </div><!-- .row -->

            <?php endforeach; ?>
            </div>

            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
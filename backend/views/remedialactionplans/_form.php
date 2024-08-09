<?php

use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Remedialactionplans $model */
/** @var yii\widgets\ActiveForm $form */

$script = <<< JS

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
        jQuery(".dynamicform_wrapper .panel-title-detail").each(function(index) {
            jQuery(this).html("Update: " + (index + 1))
        });
    });

    jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
        jQuery(".dynamicform_wrapper .panel-title-detail").each(function(index) {
            jQuery(this).html("Update: " + (index + 1))
        });
    });
JS;
$this->registerJs($script);

?>

<div class="remedialactionplans-form">

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

<?= $form->field($model, 'rapref')->hiddenInput()->label(false) ?>

<?= $form->field($model, 'schemeID')->label('Scheme')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($schemes, 'ref', function ($model) {
                return $model->ref . ' - ' . $model->name;
            }),
                'options' => ['placeholder' => '--SELECT--', 'data-validation' => 'required'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

<?= $form->field($model, 'raptype')->label('Plan Type')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($schemes, 'ref', function ($model) {
                return $model->type . ' - ' . $model->ref;
            }),
                'options' => ['placeholder' => '--SELECT--', 'data-validation' => 'required'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

<?= $form->field($model, 'deficit')->textInput() ?>

<div class="row">
    <div class="col">
        <?= $form->field($model, 'planstart')->widget(\kartik\date\DatePicker::classname(), [
            'readonly' => !$model->isNewRecord,
            'pluginOptions' => [
                'autoclose' => true,
                'daysOfWeekDisabled' => [0, 6],
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]); ?>
    </div>

    <div class="col">
    <?= $form->field($model, 'planend')->widget(\kartik\date\DatePicker::classname(), [
            'readonly' => !$model->isNewRecord,
            'pluginOptions' => [
                'autoclose' => true,
                'daysOfWeekDisabled' => [0, 6],
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]); ?>
    </div>
</div>

<div class="row">
<?= $form->field($model, 'frequency')->label('Frequency')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($frequencies, 'ref', function ($model) {
                return $model->ref . ' - ' . $model->frequency;
            }),
                'options' => ['placeholder' => '--SELECT--', 'data-validation' => 'required'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

    <div class="col">
    <?= $form->field($model, 'installmentamount')->textInput() ?>
    </div>

    <div class="col">
    <?= $form->field($model, 'runningbalance')->textInput() ?>
    </div>
</div>  

<?= $form->field($model, 'comments')->textInput(['maxlength' => true]) ?>

<div class="padding-v-md">
    <div class="line line-dashed"></div>
</div>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items', // required: css class selector
    'widgetItem' => '.item', // required: css class
    'limit' => 999, // the maximum times, an element can be cloned (default 999)
    'min' => 0, // 0 or 1 (default 1)
    'insertButton' => '.add-item', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $modelsPlanledger[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'debit',
        'credit',
        'runningbalance',
        'status',
        'duedate',
    ],
]); ?>
<div class="panel panel-default">
    <div class="mt-4 p-2 bg-primary text-white rounded">
        <i class="fa fa-tasks"></i> Plan Updates
        <button type="button" class="float-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add
            update</button>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body container-items p-2 card"><!-- widgetContainer -->
        <?php foreach ($modelsPlanledger as $index => $modelPlanledger): ?>
            <div class="item panel panel-default"><!-- widgetBody -->
                <div class="panel-heading">
                    <span class="panel-title-detail">Update:
                        <?= ($index + 1) ?>
                    </span>
                    <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i
                            class="fa fa-minus"></i></button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <?php
                    // necessary for update action.
                    if (!$modelPlanledger->isNewRecord) {
                        echo Html::activeHiddenInput($modelPlanledger, "[{$index}]id");
                    }
                    ?>
                    
                    <div class="row">                            
                        <div class="col">
                        <?= $form->field($modelPlanledger, "[{$index}]duedate")->textInput(['maxlength' => true, 'readonly' => $model->isNewRecord, 'onchange' => 'getNextdue($(this))', 'onkeyup' => 'getNextdue($(this))']) ?>  
                        </div>
                        <div class="col">
                            <?= $form->field($modelPlanledger, "[{$index}]debit")->textInput(['maxlength' => true, 'readonly' => $model->isNewRecord, 'onchange' => 'getOverdue($(this))', 'onkeyup' => 'getOverdue($(this))']) ?>
                        </div>
                        <div class="col">
                            <?= $form->field($modelPlanledger, "[{$index}]credit")->textInput(['maxlength' => true, 'readonly' => true]) ?>
                        </div>
                        <div class="col">
                            <?= $form->field($modelPlanledger, "[{$index}]status")->textInput(['maxlength' => true, 'readonly' => true]) ?>
                        </div>
                        <div class="col">
                            <?= $form->field($modelPlanledger, "[{$index}]runningbalance")->textInput(['maxlength' => true, 'readonly' => true]) ?>
                        </div>
                    </div><!-- end:row -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

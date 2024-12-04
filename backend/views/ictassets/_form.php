<?php

use common\models\Accessorylist;
use common\models\Assetcategories;
use common\models\Assetmakes;
use common\models\Assetmodels;
use common\models\Locations;
use common\models\Operatingsystem;
use common\models\Ram;
use common\models\Storage;
use dosamigos\ckeditor\CKEditor;
use kartik\depdrop\DepDrop;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap5\Button;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Ictassets $model */
/** @var yii\widgets\ActiveForm $form */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-detail").each(function(index) {
        jQuery(this).html("Accessory: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-detail").each(function(index) {
        jQuery(this).html("Accessory: " + (index + 1))
    });
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

jQuery(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});
';

$this->registerJs($js);
?>

<div class="ictassets-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'code')->hiddenInput()->label(false) ?>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'categoryID')->dropDownList(
                Assetcategories::getCategories(),
                ['prompt' => 'Select Category', 'id' => 'cat-id', 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]
            ) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'makeID')->widget(DepDrop::classname(), [
                'data' => Assetmakes::getMakesList($model->categoryID),
                'options' => ['id' => 'make-id', 'prompt' => 'Select Make', 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord],
                'pluginOptions' => [
                    'depends' => ['cat-id'],
                    'placeholder' => 'Select Make',
                    'url' => Url::to(['/ictassets/makes'])
                ]
            ]); ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'modelID')->widget(DepDrop::classname(), [
                'data' => Assetmodels::getModelsList($model->categoryID, $model->makeID),
                'options' => ['id' => 'model-id', 'prompt' => 'Select Model', 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord],
                'pluginOptions' => [
                    'depends' => ['cat-id', 'make-id'],
                    'placeholder' => 'Select Model',
                    'url' => Url::to(['/ictassets/models'])
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'tag_number')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'storageID')->dropDownList(
                ArrayHelper::map(Storage::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
                ['prompt' => 'Select Storage']                          // options
            ); ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'ramID')->dropDownList(
                ArrayHelper::map(Ram::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
                ['prompt' => 'Select RAM']                          // options
            ); ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'osID')->dropDownList(
                ArrayHelper::map(Operatingsystem::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
                ['prompt' => 'Select Operating System']                          // options
            ); ?>
        </div>
    </div>

    <?= $form->field($model, 'locationID')->dropDownList(
        ArrayHelper::map(Locations::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
        ['prompt' => 'Select Location']                          // options
    ); ?>

    <?= $form->field($model, 'assetstatus')->hiddenInput(['value' => $model->isNewRecord ? 1 : $model->assetstatus])->label(false)  ?>

    <?= $form->field($model, 'assetcondition')->textInput(['maxlength' => true]) ?>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsAssetaccessories[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'code',
            'name',
            'description',
        ],
    ]); ?>

<div class="panel panel-default">
        <div class="mt-4 p-2 bg-primary text-white rounded">
            <i class="fa fa-tasks"></i> Accessory List
            <button type="button" class="float-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add
                accessory</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items p-2 card"><!-- widgetContainer -->
            <?php foreach ($modelsAssetaccessories as $index => $modelAssetaccessories): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-detail">Accessory:
                            <?= ($index + 1) ?>
                        </span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i
                                class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                        // necessary for update action.
                        if (!$modelAssetaccessories->isNewRecord) {
                            echo Html::activeHiddenInput($modelAssetaccessories, "[{$index}]id");
                        }
                        ?>                        
                        <div class="row">
                            <div class="col">
                                <?= $form->field($modelAssetaccessories, "[{$index}]accessorylistID")->dropDownList(
        ArrayHelper::map(Accessorylist::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
        ['prompt' => 'Select Accessory']                          // options
    ); ?>
                            </div>
                        </div><!-- end:row -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <!-- <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?> -->
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
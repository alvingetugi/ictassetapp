<?php

use common\models\Category;
use common\models\Equipmentmodel;
use common\models\Location;
use common\models\Make;
use dosamigos\ckeditor\CKEditor;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Equipment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="equipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    <div class="col-sm-3 col-md-3">
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    </div>
    
    <div class="col-sm-3 col-md-3">
    <?= $form->field($model, 'category_id')->dropDownList(
        Category::getCategories(),
        ['prompt' => 'Select Category', 'id' => 'cat-id']
    ) ?>
    </div>

    <div class="col-sm-3 col-md-3">
    <?= $form->field($model, 'make_id')->widget(DepDrop::classname(), [
        'data' => Make::getMakesList($model->category_id),
        'options' => ['id' => 'make-id', 'prompt' => 'Select Category'],
        'pluginOptions' => [
            'depends' => ['cat-id'],
            'placeholder' => 'Select Make',
            'url' => Url::to(['/equipment/makes'])
        ]
    ]); ?>
    </div>

    <div class="col-sm-3 col-md-3">
    <?= $form->field($model, 'equipmodel_id')->widget(DepDrop::classname(), [
        'data' => Equipmentmodel::getModelsList($model->category_id, $model->make_id),
        'options' => ['id' => 'model-id', 'prompt' => 'Select Model'],
        'pluginOptions' => [
            'depends' => ['cat-id', 'make-id'],
            'placeholder' => 'Select Model',
            'url' => Url::to(['/equipment/models'])
        ]
    ]); ?>
    </div>
    </div>

    <div class="row">
    <div class="col-sm-3 col-md-3">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-3 col-md-3">
    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-3 col-md-3">
    <?= $form->field($model, 'tag_number')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-3 col-md-3">
    <?= $form->field($model, 'location_id')->dropDownList(
		        ArrayHelper::map(Location::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
		        ['prompt'=>'Select Location']                          // options
		    ); ?>

    </div>
    </div>

    <?= $form->field($model, 'details')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'date_of_delivery')->textInput() ?>

    <div class="row">
    <div class="col-sm-3 col-md-3">
    <?= $form->field($model, 'status')->checkbox() ?>
    </div>

    <div class="col-sm-3 col-md-3">
    <?= $form->field($model, 'condition')->checkbox() ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
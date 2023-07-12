<?php

use common\models\Category;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Asset $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asset-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->dropDownList(Category::getCategories(),
    ['prompt' => 'Select Category', 'id' => 'cat-id']) ?>

    <?= $form->field($model, 'make')->widget(DepDrop::classname(), [
            'options' => ['id' => 'make-id', 'prompt' => 'Select Category'],
            'pluginOptions' => [
                'depends' => ['cat-id'],
                'placeholder' => 'Select Make',
                'url' => Url::to(['/asset/makes'])
            ]
        ]); ?>

    <?= $form->field($model, 'model')->widget(DepDrop::classname(), [
            'options' => ['prompt' => 'Select Model'],
            'pluginOptions' => [
                'depends' => ['cat-id', 'make-id'],
                'placeholder' => 'Select Model',
                'url' => Url::to(['/asset/models'])
            ]
        ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'details')->textInput() ?>

    <?= $form->field($model, 'date_of_delivery')->textInput() ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'condition')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

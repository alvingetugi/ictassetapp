<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use common\models\Assetmaster;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;


/** @var yii\web\View $this */
/** @var common\models\Assets $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'model')->dropDownList(Assetmaster::getModels(), ['prompt' =>'Select Model...', 'id' => 'model-id']) ?>

    <?= $form->field($model, 'asset_master_id')->widget(DepDrop::classname(), [
    'options'=>['id'=>'relmastasst-id', 'prompt' =>'Select Category...'],
    'pluginOptions'=>[
        'depends'=>['model-id'],
        'placeholder'=>'Select Category...',
        'url'=>Url::to(['assets/relmastasst'])
    ]
]); ?>

    <?= $form->field($model, 'location_id')->textInput() ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'storage')->textInput() ?>

    <?= $form->field($model, 'ram')->textInput() ?>

    <?= $form->field($model, 'accessories')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'condition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

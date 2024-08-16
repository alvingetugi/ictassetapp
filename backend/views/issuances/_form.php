<?php

use common\models\Assetcategories;
use common\models\Assetmodels;
use common\models\Ictassets;
use common\models\User;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Issuances $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="issuances-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->hiddenInput()->label(false) ?>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'issuancedate')->widget(\kartik\date\DatePicker::classname(), [
                'readonly' => !$model->isNewRecord,
                'disabled' => !$model->isNewRecord,
                'pluginOptions' => [
                    'autoclose' => true,
                    'daysOfWeekDisabled' => [0, 6],
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]); ?>
        </div>

        <div class="col">
            <?= $form->field($model, 'categoryID')->dropDownList(
                Assetcategories::getCategories(),
                ['prompt' => 'Select Category', 'id' => 'cat-id', 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]
            ) ?>
        </div>

        <div class="col">
            <?= $form->field($model, 'modelID')->widget(DepDrop::classname(), [
                'data' => Assetmodels::getModelListissuance($model->categoryID),
                'options' => ['id' => 'model-id', 'prompt' => 'Select Model', 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord],
                'pluginOptions' => [
                    'depends' => ['cat-id'],
                    'placeholder' => 'Select Model',
                    'url' => Url::to(['/ictassets/modelissuances'])
                ]
            ]); ?>
        </div>

        <div class="col">
            <?= $form->field($model, 'serialnumber')->widget(DepDrop::classname(), [
                'data' => Ictassets::getSerialsList($model->categoryID, $model->modelID),
                'options' => ['id' => 'serialnumber', 'prompt' => 'Select Serial Number', 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord],
                'pluginOptions' => [
                    'depends' => ['cat-id', 'model-id'],
                    'placeholder' => 'Select Serial Number',
                    'url' => Url::to(['/ictassets/serialnumbers'])
                ]
            ]); ?>
        </div>
    </div>

    <?= $form->field($model, 'userID')->dropDownList(        
        ArrayHelper::map(User::find()->all(),'id', function($array, $default){return $array['firstname'] . ' '. $array['lastname'];}),
        ['prompt' => 'Select Staff', 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]
    ); ?>

    <?= $form->field($model, 'comments')->textarea(['maxlength' => true, 'rows'=> 6, 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
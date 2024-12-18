<?php

use common\models\Accessorylist;
use common\models\Assetcategories;
use common\models\Assetmodels;
use common\models\Ictassets;
use common\models\User;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
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

    <?= $form->field($model, 'code')->hiddenInput(['value' => $model->isNewRecord ? 'ISS' . '_' . Yii::$app->security->generateRandomString(5) . '_' . time() : $model->code])->label(false) ?>
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
                ['prompt' => 'Select Category', 'id' => 'cat-id']
            ) ?>
        </div>

        <div class="col">
            <?= $form->field($model, 'modelID')->widget(DepDrop::classname(), [
                'data' => Assetmodels::getModelListissuance($model->categoryID),
                'options' => ['id' => 'model-id', 'prompt' => 'Select Model'],
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
                'options' => ['id' => 'serialnumber', 'prompt' => 'Select Serial Number'],
                'pluginOptions' => [
                    'depends' => ['cat-id', 'model-id'],
                    'placeholder' => 'Select Serial Number',
                    'url' => Url::to(['/ictassets/serialnumbers'])
                ]
            ]); ?>
        </div>
    </div>

    <?= $form->field($model, 'accessorylistID')->widget(DepDrop::classname(), [
        'data' => Ictassets::getAccessoryList($model->categoryID, $model->modelID, $model->serialnumber),
        'options' => [
            'id' => 'accessorylist-id',
            'prompt' => 'Select Accessories',
            'multiple' => true,
            'size' => 5
        ],
        'pluginOptions' => [
            'depends' => ['cat-id', 'model-id', 'serialnumber'],
            'placeholder' => 'Select Accessories',
            'url' => Url::to(['/ictassets/accessorylist'])
        ]
    ]); ?>

    <?= $form->field($model, 'userID')->dropDownList(
        ArrayHelper::map(User::find()->all(), 'id', function ($array, $default) {
            return $array['firstname'] . ' ' . $array['lastname']; }),
        ['prompt' => 'Select Staff']
    ); ?>

    <?= $form->field($model, 'comments')->textarea(['maxlength' => true, 'rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
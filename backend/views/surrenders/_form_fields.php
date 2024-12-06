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
/** @var common\models\Surrenders $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="surrenders-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'code')->hiddenInput(['value' => $model->isNewRecord ? 'SUR' . '_' . Yii::$app->security->generateRandomString(5) . '_' . time() : $model->code])->label(false) ?>
<div class="row">
<div class="col">
        <?= $form->field($model, 'surrenderdate')->widget(\kartik\date\DatePicker::classname(), [
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
        <?= $form->field($model, 'categoryID')->textInput(['id' => 'surrender-form-categoryID', 'readonly' => true]) ?>
        </div>

        <div class="col">
        <?= $form->field($model, 'modelID')->textInput(['id' => 'surrender-form-modelID', 'readonly' => true]) ?>
        </div>

        <div class="col">
        <?= $form->field($model, 'serialnumber')->textInput(['id' => 'surrender-form-serialnumber', 'readonly' => true]) ?>
        </div>

<?=  $form->field($model, 'accessorylistID')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Accessorylist::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select accessory', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'maximumInputLength' => 10
        ],
    ]) ?>

</div>

<?= $form->field($model, 'userID')->dropDownList(        
        ArrayHelper::map(User::find()->all(),'id', function($array, $default){return $array['firstname'] . ' '. $array['lastname'];}),
        ['prompt' => 'Select Staff', 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]
    ); ?>

<?= $form->field($model, 'comments')->textarea(['maxlength' => true, 'rows'=> 6, 'readonly' => !$model->isNewRecord, 'disabled' => !$model->isNewRecord]) ?>


<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>

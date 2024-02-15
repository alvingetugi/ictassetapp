<?php

use common\models\Assetcategories;
use common\models\Assetmakes;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Assetmodels $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assetmodels-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'categoryID')->dropDownList(Assetcategories::getCategories(),
    ['prompt' => 'Select Category', 'id' => 'cat-id']) ?>

    <?= $form->field($model, 'makeID')->widget(DepDrop::classname(), [
            'data' => Assetmakes::getMakesList($model->categoryID),
            'options' => ['id' => 'make-id', 'prompt' => 'Select Make'],
            'pluginOptions' => [
                'depends' => ['cat-id'],
                'placeholder' => 'Select Make',
                'url' => Url::to(['/ictassets/makes']) //Url::to(['/controller/action'])
            ]
        ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

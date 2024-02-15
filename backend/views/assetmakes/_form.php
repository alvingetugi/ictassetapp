<?php

use common\models\Assetcategories;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Assetmakes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assetmakes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'categoryID')->dropDownList(
		        ArrayHelper::map(Assetcategories::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
		        ['prompt'=>'Select Category']                          // options
		    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

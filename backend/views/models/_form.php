<?php

use backend\models\search\MakeSearch;
use common\models\Category;
use common\models\Make;
use common\models\Models;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Models $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="models-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList(
		        ArrayHelper::map(Category::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
		        ['prompt'=>'Select Category']                          // options
		    ); ?>

    <?= $form->field($model, 'make_id')->dropDownList(
		        ArrayHelper::map(Make::find()->all(), 'id', 'name'),  // Flat array ('id'=>'label')
		        ['prompt'=>'Select Make']                          // options
		    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

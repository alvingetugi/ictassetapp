<?php

use common\models\Category;
use common\models\Make;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Equipmentmodel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="equipmentmodel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(Category::getCategories(),
    ['prompt' => 'Select Category', 'id' => 'cat-id']) ?>

    <?= $form->field($model, 'make_id')->widget(DepDrop::classname(), [
            'data' => Make::getMakesList($model->category_id),
            'options' => ['id' => 'make-id', 'prompt' => 'Select Make'],
            'pluginOptions' => [
                'depends' => ['cat-id'],
                'placeholder' => 'Select Make',
                'url' => Url::to(['/equipment/makes'])
            ]
        ]); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

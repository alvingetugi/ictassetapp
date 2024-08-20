<?php

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Authassignment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="authassignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(        
        ArrayHelper::map(User::find()->all(),'id', function($array, $default){return $array['firstname'] . ' '. $array['lastname'];}),
        ['prompt' => 'Select Staff']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

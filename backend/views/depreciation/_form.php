<?php

use common\models\Equipment;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Depreciation $model */
/** @var yii\widgets\ActiveForm $form */

$script = <<<JS
  var calculateDepreciation = function () {
        var purchaseStr = parseInt($('#depreciation-purchase_value').val());
        var purchasevalue = isNaN(purchaseStr) ? 0 : purchaseStr;
        var currentvalue = purchasevalue * 5;
        $('#depreciation-current_value').val(currentvalue);
    };
    $(document).on('click', '#depreciation-current_value', function () {
        calculateDepreciation();
    });
JS;
$this->registerJs($script);

?>

<div class="depreciation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipment_id')->dropDownList(
        ArrayHelper::map(Equipment::find()->all(), 'id', 'name'),
        // Flat array ('id'=>'label')
        ['prompt' => 'Select Equipment'] // options
    ); ?>

    <?= $form->field($model, 'purchase_value')->textInput() ?>

    <?= $form->field($model, 'current_value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
   
    <?php ActiveForm::end(); ?>

</div>
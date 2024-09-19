<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this yii\web\View */
/** @var common\models\ExcelUploadForm $model */
?>

<div class="site-import">
    <h1>Import Excel Data</h1>

    <?php $form = ActiveForm::begin(['action' => ['rapschedules/import'], 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

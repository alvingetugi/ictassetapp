<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Depreciation $model */

$this->title = 'Update Depreciation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Depreciations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="depreciation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

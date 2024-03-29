<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assetmodels $model */

$this->title = 'Update Model: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assetmodels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assetmodels-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

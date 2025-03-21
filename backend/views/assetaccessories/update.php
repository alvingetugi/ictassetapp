<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assetaccessories $model */

$this->title = 'Update Assetaccessories: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Assetaccessories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assetaccessories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

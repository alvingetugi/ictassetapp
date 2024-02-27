<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Maintenanceout $model */

$this->title = 'Update Maintenanceout: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Maintenanceouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="maintenanceout-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

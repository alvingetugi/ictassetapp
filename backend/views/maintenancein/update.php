<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Maintenancein $model */

$this->title = 'Update Maintenancein: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Maintenanceins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="maintenancein-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Maintenanceout $model */

$this->title = 'Create Maintenanceout';
$this->params['breadcrumbs'][] = ['label' => 'Maintenanceouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenanceout-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

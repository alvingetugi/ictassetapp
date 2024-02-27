<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Maintenancein $model */

$this->title = 'Create Maintenancein';
$this->params['breadcrumbs'][] = ['label' => 'Maintenanceins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenancein-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

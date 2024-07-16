<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Remedialactionplans $model */

$this->title = 'Update Remedialactionplans: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Remedialactionplans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="remedialactionplans-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'schemes' => $schemes,
        'frequencies' => $frequencies,
        'modelsPlanledger' => $modelsPlanledger
    ]) ?>

</div>

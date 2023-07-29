<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Transactiontype $model */

$this->title = 'Update Transactiontype: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transactiontypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transactiontype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Transactiondetails $model */

$this->title = 'Update Transactiondetails: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transactiondetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transactiondetails-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Operatingsystem $model */

$this->title = 'Update Operatingsystem: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Operatingsystems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="operatingsystem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

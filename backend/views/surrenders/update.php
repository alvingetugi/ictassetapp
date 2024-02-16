<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Surrenders $model */

$this->title = 'Update Surrender: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Surrenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surrenders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

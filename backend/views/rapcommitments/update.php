<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Rapcommitments $model */

$this->title = 'Update Rapcommitments: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rapcommitments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rapcommitments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'raps' => $raps,
    ]) ?>

</div>

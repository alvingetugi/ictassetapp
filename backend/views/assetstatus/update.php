<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assetstatus $model */

$this->title = 'Update Status: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assetstatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assetstatus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Authrule $model */

$this->title = 'Update Authrule: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Authrules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'name' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="authrule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

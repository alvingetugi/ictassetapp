<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Rappayments $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rappayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rappayments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

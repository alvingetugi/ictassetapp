<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Issuances $model */

$this->title = 'Update Issuances: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Issuances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="issuances-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

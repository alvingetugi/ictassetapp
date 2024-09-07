<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Rapscheduletypes $model */

$this->title = 'Update Rapscheduletypes: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rapscheduletypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rapscheduletypes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

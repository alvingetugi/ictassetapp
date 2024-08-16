<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Rapschedules $model */

$this->title = 'Update Rapschedules: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rapschedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rapschedules-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

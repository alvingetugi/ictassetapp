<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Rap $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Raps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rap-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'schemes' => $schemes,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Ram $model */

$this->title = 'Create Ram';
$this->params['breadcrumbs'][] = ['label' => 'Rams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ram-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Make $model */

$this->title = 'Create Make';
$this->params['breadcrumbs'][] = ['label' => 'Makes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="make-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Departments $model */

$this->title = 'Create Department';
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

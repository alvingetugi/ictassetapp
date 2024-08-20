<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Authassignment $model */

$this->title = 'Create Role Assigment';
$this->params['breadcrumbs'][] = ['label' => 'Authassignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authassignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

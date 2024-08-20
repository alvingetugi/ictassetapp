<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Authitemchild $model */

$this->title = 'Update Authitemchild: ' . $model->child;
$this->params['breadcrumbs'][] = ['label' => 'Authitemchildren', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->child, 'url' => ['view', 'child' => $model->child, 'parent' => $model->parent]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="authitemchild-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

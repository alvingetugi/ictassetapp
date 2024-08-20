<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Authitem $model */

$this->title = 'Update Authitem: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Authitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'name' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="authitem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

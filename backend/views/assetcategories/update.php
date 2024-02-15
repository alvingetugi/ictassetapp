<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assetcategories $model */

$this->title = 'Update Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assetcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assetcategories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

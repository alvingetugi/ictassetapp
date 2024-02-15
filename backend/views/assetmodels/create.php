<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assetmodels $model */

$this->title = 'Create Model';
$this->params['breadcrumbs'][] = ['label' => 'Assetmodels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assetmodels-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

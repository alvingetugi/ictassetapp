<?php

use common\models\Assetmodels;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Ictassets $model */

$this->title = 'Update Asset: ' . Assetmodels::findOne(['id'=>$model->modelID])->name.'-'.$model->name;;
$this->params['breadcrumbs'][] = ['label' => 'Ictassets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ictassets-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsAssetaccessories' => $modelsAssetaccessories,
    ]) ?>

</div>

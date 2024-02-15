<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Ictassets $model */

$this->title = 'Create Asset';
$this->params['breadcrumbs'][] = ['label' => 'Ictassets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ictassets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsAssetaccessories' => $modelsAssetaccessories,
    ]) ?>

</div>

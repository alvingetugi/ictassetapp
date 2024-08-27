<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assetaccessories $model */

$this->title = 'Create Accessory';
$this->params['breadcrumbs'][] = ['label' => 'Assetaccessories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assetaccessories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

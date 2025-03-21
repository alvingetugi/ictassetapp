<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Storage $model */

$this->title = 'Create Storage';
$this->params['breadcrumbs'][] = ['label' => 'Storages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

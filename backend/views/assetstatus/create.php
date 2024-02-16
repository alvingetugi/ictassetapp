<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assetstatus $model */

$this->title = 'Create Status';
$this->params['breadcrumbs'][] = ['label' => 'Assetstatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assetstatus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

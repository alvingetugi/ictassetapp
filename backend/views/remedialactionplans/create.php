<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Remedialactionplans $model */

$this->title = 'Create Remedialactionplans';
$this->params['breadcrumbs'][] = ['label' => 'Remedialactionplans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="remedialactionplans-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'schemes' => $schemes,
        'frequencies' => $frequencies,
        'modelsPlanledger' => $modelsPlanledger
    ]) ?>

</div>

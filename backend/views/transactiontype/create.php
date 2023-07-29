<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Transactiontype $model */

$this->title = 'Create Transactiontype';
$this->params['breadcrumbs'][] = ['label' => 'Transactiontypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactiontype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

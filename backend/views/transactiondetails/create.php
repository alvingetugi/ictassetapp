<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Transactiondetails $model */

$this->title = 'Create Transactiondetails';
$this->params['breadcrumbs'][] = ['label' => 'Transactiondetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactiondetails-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

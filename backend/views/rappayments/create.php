<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Rappayments $model */

$this->title = 'Create Rappayments';
$this->params['breadcrumbs'][] = ['label' => 'Rappayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rappayments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Rapcommitments $model */

$this->title = 'Create Commitment';
$this->params['breadcrumbs'][] = ['label' => 'Rapcommitments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rapcommitments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'raps' => $raps,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Raptypes $model */

$this->title = 'Create Remedial Action Plan Type';
$this->params['breadcrumbs'][] = ['label' => 'Raptypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raptypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

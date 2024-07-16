<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Rap $model */

$this->title = 'Create Remedial Action Plan';
$this->params['breadcrumbs'][] = ['label' => 'Raps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'schemes' => $schemes,
    ]) ?>

</div>

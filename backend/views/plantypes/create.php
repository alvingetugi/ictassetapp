<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Plantypes $model */

$this->title = 'Create Plan Type';
$this->params['breadcrumbs'][] = ['label' => 'Plantypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plantypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

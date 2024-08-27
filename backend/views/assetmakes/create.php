<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assetmakes $model */

$this->title = 'Create Make';
$this->params['breadcrumbs'][] = ['label' => 'Assetmakes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assetmakes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

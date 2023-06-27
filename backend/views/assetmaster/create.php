<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assetmaster $model */

$this->title = 'Create an Asset Master';
$this->params['breadcrumbs'][] = ['label' => 'Assetmasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assetmaster-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

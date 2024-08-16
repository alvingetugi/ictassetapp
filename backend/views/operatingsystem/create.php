<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Operatingsystem $model */

$this->title = 'Create Operatingsystem';
$this->params['breadcrumbs'][] = ['label' => 'Operatingsystems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operatingsystem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

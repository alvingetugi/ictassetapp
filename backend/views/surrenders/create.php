<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Surrenders $model */

$this->title = 'Create Surrenders';
$this->params['breadcrumbs'][] = ['label' => 'Surrenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surrenders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

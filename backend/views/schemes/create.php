<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Schemes $model */

$this->title = 'Create Schemes';
$this->params['breadcrumbs'][] = ['label' => 'Schemes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schemes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

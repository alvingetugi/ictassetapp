<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Authrule $model */

$this->title = 'Create Authrule';
$this->params['breadcrumbs'][] = ['label' => 'Authrules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authrule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

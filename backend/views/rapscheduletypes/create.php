<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Rapscheduletypes $model */

$this->title = 'Create Rapscheduletypes';
$this->params['breadcrumbs'][] = ['label' => 'Rapscheduletypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rapscheduletypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

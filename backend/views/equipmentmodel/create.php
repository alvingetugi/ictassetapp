<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Equipmentmodel $model */

$this->title = 'Create Model';
$this->params['breadcrumbs'][] = ['label' => 'Equipmentmodels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipmentmodel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

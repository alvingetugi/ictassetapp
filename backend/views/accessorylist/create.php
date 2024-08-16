<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Accessorylist $model */

$this->title = 'Create Accessorylist';
$this->params['breadcrumbs'][] = ['label' => 'Accessorylists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accessorylist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

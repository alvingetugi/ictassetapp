<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Depreciation $model */

$this->title = 'Create Depreciation';
$this->params['breadcrumbs'][] = ['label' => 'Depreciations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="depreciation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assetcategories $model */

$this->title = 'Create Category';
$this->params['breadcrumbs'][] = ['label' => 'Assetcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assetcategories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Models $model */

$this->title = 'Create Models';
$this->params['breadcrumbs'][] = ['label' => 'Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

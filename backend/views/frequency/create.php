<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Frequency $model */

$this->title = 'Create Frequency';
$this->params['breadcrumbs'][] = ['label' => 'Frequencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frequency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

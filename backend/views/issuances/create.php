<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Issuances $model */

$this->title = 'Create Issuances';
$this->params['breadcrumbs'][] = ['label' => 'Issuances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issuances-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

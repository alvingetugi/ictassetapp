<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Planledger $model */

$this->title = 'Create Planledger';
$this->params['breadcrumbs'][] = ['label' => 'Planledgers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planledger-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

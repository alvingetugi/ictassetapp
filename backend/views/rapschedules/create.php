<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Rapschedules $model */

$this->title = 'Create Schedule';
$this->params['breadcrumbs'][] = ['label' => 'Rapschedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rapschedules-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

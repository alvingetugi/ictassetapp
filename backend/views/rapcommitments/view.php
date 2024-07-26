<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Rapcommitments $model */

$this->title = 'Commitment:'. ' '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rapcommitments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rapcommitments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'rapID',
            'date',
            'expectedamount',
            'comments',
            [
                'attribute' => 'document',
                'format' => ['html'],
                'value' => fn() => Html::a('Download', [
                    'rapcommitments/pdf',
                    'id' => $model->id,
                ], [
                    'class' => 'btn btn-primary',
                    'target' => '_blank',
                ]),
            ],            
        ],
    ]) ?>

</div>

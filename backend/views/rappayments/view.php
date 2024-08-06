<?php

use common\models\Rap;
use common\models\Rapcommitments;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Rappayments $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rappayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rappayments-view">

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
            [
                'label' => 'RAP',
                'value' => function ($data){
                    return Rap::findOne(['id'=>$data->rapID])->name;
                }
            ],
            [
                'label' => 'Commitment',
                'value' => function ($data){
                    return Rapcommitments::findOne(['id'=>$data->commitmentID])->name;
                }
            ],
            // 'name',
            'paymentdate',
            'amount',
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

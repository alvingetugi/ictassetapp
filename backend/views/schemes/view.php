<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Schemes $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Schemes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="schemes-view">

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
            'ref',
            'type',
            'name',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'RAP',
                'attribute' => 'rapref'
            ],
            [
                'label' => 'Type',
                'attribute' => 'raptype'
            ],
            [
                'label' => 'Status',
                'attribute' => 'rapstatus'
            ],
            [
                'label' => 'Deficit',
                'attribute' => 'deficit'
            ],
            [
                'label' => 'Start',
                'attribute' => 'startdate'
            ], 
            [
                'label' => 'Schedule Amount',
                'attribute' => 'total'
            ], 
            [
                'label' => 'Paid',
                'attribute' => 'totalpaid'
            ], 
            [
                'label' => 'Balance',
                'attribute' => 'balance'
            ], 
        ],
    ]); ?>

</div>

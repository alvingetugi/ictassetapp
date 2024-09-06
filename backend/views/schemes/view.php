<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;

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

<?= TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'Remedial Action Plans',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'content' => GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
        
                    [
                        'label' => 'REF',
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
                        'label' => 'End',
                        'attribute' => 'enddate'
                    ],
                ],
            ]),
            'active' => true
        ],
        [
            'label' => 'RAP Schedules',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'content' => GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
        
                    [
                        'label' => 'REF',
                        'attribute' => 'rapref'
                    ],
                    [
                        'label' => 'Type',
                        'attribute' => 'raptype'
                    ],
                    [
                        'label' => 'Deficit',
                        'attribute' => 'deficit'
                    ],
                    [
                        'label' => 'Schedule Amount',
                        'attribute' => 'expectedamount'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                    return (Html::a('View', Url::to(['rapschedules/view', 'id' => $model['scheduleID']]), ['class' => 'btn btn-primary']));
                            },
                        ],
                    ],
                    
                ],
            ]),

        ],
        [
            'label' => 'Report',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'content' => GridView::widget([
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
                        'attribute' => 'expectedamount'
                    ], 
                    [
                        'label' => 'Paid',
                        'attribute' => 'totalpayments'
                    ], 
                    [
                        'label' => 'Balance',
                        'attribute' => 'balance'
                    ], 
                ],
            ]),
        ],
        
        [
            'label' => 'Dropdown',
            'items' => [
                 [
                     'label' => 'DropdownA',
                     'content' => 'DropdownA, Anim pariatur cliche...',
                 ],
                 [
                     'label' => 'DropdownB',
                     'content' => 'DropdownB, Anim pariatur cliche...',
                 ],
            ],
        ],
    ],
    ]) ?>


</div>

<?php

use common\models\Rappayments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\RappaymentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Remedial Action Plan Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rappayments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Payment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'rapID',
                'value' => 'rap.name'
            ],
            [
                'attribute' => 'scheduleID',
                'value' => 'schedule.name'
            ],
            // 'name',
            'paymentdate',
            'amount',
            //'comments',
            [
                'label' => 'Proof',
                'attribute' => 'proof',
                'content' => function ($model) {
                    /** @var \common\models\Rappayments $model */
                    return  Html::a('Download', [
                        'rappayments/pdf',
                        'id' => $model->id,
                    ], [
                        'class' => 'btn btn-primary',
                        'target' => '_blank',
                    ]);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                            return (Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']));
                    },
                ],
            ],
        ],
    ]); ?>


</div>

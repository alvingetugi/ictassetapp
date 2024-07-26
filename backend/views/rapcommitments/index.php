<?php

use common\models\Rapcommitments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\RapcommitmentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Remedial Action Plan Commitments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rapcommitments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'rapID',
            'date',
            'expectedamount',
            'comments',
            // 'document', 
            [
                'label' => 'Document',
                'attribute' => 'document',
                'content' => function ($model) {
                    /** @var \common\models\Rapcommitments $model */
                    return  Html::a('Download', [
                        'rapcommitments/pdf',
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
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, Rapcommitments $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>


</div>

<?php

use common\models\Rap;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\RapSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Remedial Action Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rap-index">

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
            [
                'attribute' => 'typeID',
                'value' => 'type.name'
            ],
            [
                'attribute' => 'schemeID',
                'value' => 'scheme.name'
            ],
            [
                'attribute' => 'status',
                'content' => function ($model) {
                    /** @var \common\models\Rap $model */
                    return Html::tag('span', $model->status ? 'Active' : 'Inactive', [
                        'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                    ]);
                }
            ],
            'amount',
            'startdate',
            //'enddate',
            //'comments',
            //'rapdocument',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
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

<?php

use common\models\Ictassets;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\IctassetsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ICT Assets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ictassets-index">

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
            // 'code',
            [
                'attribute' => 'categoryID',
                'value' => 'category.name'
            ],
            // [
            //     'attribute' => 'makeID',
            //     'value' => 'make.name'
            // ],
            [
                'attribute' => 'modelID',
                'value' => 'model.name'
            ],
            'name',
            'tag_number',
            //'storageID',
            //'ramID',
            //'osID',
            //'locationID',
            [
                'attribute' => 'assetstatus',
                'value' => 'assetStatus.name'
            ],
            //'assetcondition',
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

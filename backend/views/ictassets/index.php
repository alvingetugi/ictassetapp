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
        <?= Html::a('Create Asset', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel, 'pageSize' => $pageSize]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'code',
            // [
            //     'attribute' => 'categoryID',
            //     'value' => 'category.name'
            // ],
            // [
            //     'attribute' => 'makeID',
            //     'value' => 'make.name'
            // ],
            [
                'attribute' => 'modelID',
                'value' => 'model.name'
            ],
            'name',
            //'tag_number',
            //'storage',
            //'ram',
            //'operating_system',
            //'date_of_delivery',
            //'locationID',
            // 'assetstatus',
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
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Ictassets $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

<?php

use common\models\Surrenders;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\SurrendersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Surrenders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surrenders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Surrender', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'code',
            'surrenderdate',
            // 'categoryID',
             [
                'attribute' => 'modelID',
                'value' => 'model.name'
            ],
            [
                'attribute' => 'serialnumber',
                'value' => 'serials.name'
            ],
            [
                'attribute' => 'userID',
                'value' => 'user.username'
            ],
            //'comments',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'template'=>'{view}{update}',
                'urlCreator' => function ($action, Surrenders $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

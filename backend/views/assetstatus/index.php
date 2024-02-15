<?php

use common\models\Assetstatus;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\AssetstatusSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Assetstatuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assetstatus-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Assetstatus', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Assetstatus $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

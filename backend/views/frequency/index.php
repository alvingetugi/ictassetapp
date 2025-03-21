<?php

use common\models\Frequency;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\FrequencySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Frequencies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frequency-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Frequency', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ref',
            'frequency',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Frequency $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

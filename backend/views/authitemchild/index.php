<?php

use common\models\Authitemchild;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\AuthitemchildSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Authitemchildren';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitemchild-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Authitemchild', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'parent',
            'child',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Authitemchild $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'child' => $model->child, 'parent' => $model->parent]);
                 }
            ],
        ],
    ]); ?>


</div>

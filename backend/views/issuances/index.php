<?php

use common\models\Issuances;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\IssuancesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Issuances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issuances-index">

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
            'code',
            'issuancedate',
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
                'label' => 'Staff Allocated',
                'attribute' => 'userID',
                'value' => 'user.displayName'
            ],
            //'comments',
            // 'accessorylistID'
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

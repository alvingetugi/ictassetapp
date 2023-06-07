<?php
use yii\debug\models\timeline\DataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use common\models\Product;

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ICT Asset App';
?>
<div class="site-index">
    <!-- <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Congratulations!</h1>
            <p class="fs-5 fw-light">You have successfully created your Yii-powered application.</p>
            <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
        </div>
    </div> -->

    <div class="body-content">

     

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],
        
                [
                    'attribute' => 'id',
                    'contentOptions' => [
                        'style' => 'width: 60px'
                    ]
                ],
                'name',
                // 'description',
                // 'image',
                [
                    'label' => 'Image',
                    'attribute' => 'image',
                    'content' => function ($model) {
                        /** @var \common\models\Product $model */
                        return Html::img($model->getImageUrl(), ['style' => 'width: 70px']);
                    }
                ],
                // 'price:currency',
                [
                    'attribute' => 'status',
                    'content' => function ($model) {
                        /** @var \common\models\Product $model */
                        return Html::tag('span', $model->status ? 'Available' : 'Draft', [
                            'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                        ]);
                    }
                ],
                [
                    'attribute' => 'created_at',
                    'format' => ['datetime'],
                    'contentOptions' => ['style' => 'white-space: nowrap']
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => ['datetime'],
                    'contentOptions' => ['style' => 'white-space: nowrap']
                ],
                //'created_by',
                //'updated_by',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                     }
                ],
            ],
        ]); ?>

    </div>
</div>
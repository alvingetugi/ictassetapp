<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use common\models\Product;

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */
/** @var \common\models\Product $model*/

$this->title = 'ICT Asset App';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                
                ['class' => 'yii\grid\CheckboxColumn'],
                ['class' => 'yii\grid\SerialColumn'],
        
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
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'headerOptions' => ['style' => 'color:#0d6efd'],
                    'template' => '{buttonAdd}',
                    'buttons' => [
                    'buttonAdd' => function($url, $model, $key) {     
                        return Html::a('Add', Url::to(['/cart/add']));
                }
            ]
                ],
            ],
        ]); ?>

</div>
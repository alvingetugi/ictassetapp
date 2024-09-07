<?php

use common\models\Raptypes;
use common\models\Schemes;
use kartik\tabs\TabsX;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Rap $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Raps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rap-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'label' => 'Type',
                'value' => function ($data){
                    return Raptypes::findOne(['id'=>$data->typeID])->name;
                }
            ],
            [
                'label' => 'Scheme',
                'value' => function ($data){
                    return Schemes::findOne(['id'=>$data->schemeID])->name;
                }
            ],
            // 'name',
            // ['attribute'=>'status','value'=>function($model){
            //     return $model->status ? 'Active' : 'Inactive';
            // }],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => fn() => Html::tag('span', $model->status ? 'Active' : 'Inactive', [
                    'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                ]),
            ],
            'amount',
            'startdate',
            'enddate',
            'comments',
            [
                'attribute' => 'rapdocument',
                'format' => ['html'],
                'value' => fn() => Html::a('Download', [
                    'rap/pdf',
                    'id' => $model->id,
                ], [
                    'class' => 'btn btn-primary',
                    'target' => '_blank',
                ]),
            ],
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

<?= TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'Statement',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'content' => GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                           
                    [
                        'label' => 'Description',
                        'attribute' => 'description'
                    ],
                    [
                        'label' => 'Debits',
                        'attribute' => 'debits'
                    ],
                    [
                        'label' => 'Credits',
                        'attribute' => 'credits'
                    ],
                    [
                        'label' => 'Balance',
                        'attribute' => 'balance'
                    ],
                ],
            ]),
            'active' => true
        ],    

    ],
    ]) ?>

</div>

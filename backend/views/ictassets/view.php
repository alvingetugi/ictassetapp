<?php

use common\models\Accessorylist;
use common\models\Assetaccessories;
use common\models\Assetcategories;
use common\models\Assetmakes;
use common\models\Assetmodels;
use common\models\Assetstatus;
use common\models\Ictassets;
use common\models\Locations;
use common\models\Operatingsystem;
use common\models\Ram;
use common\models\Storage;
use kartik\tabs\TabsX;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Ictassets $model */

$this->title = Assetmodels::findOne(['id'=>$model->modelID])->name.'-'.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ictassets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ictassets-view">

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
            'code',
            [
                'label' => 'Category',
                'value' => function ($data){
                    return Assetcategories::findOne(['id'=>$data->categoryID])->name;
                }
            ],
            [
                'label' => 'Make',
                'value' => function ($data){
                    return Assetmakes::findOne(['id'=>$data->makeID])->name;
                }
            ],
            [
                'label' => 'Model',
                'value' => function ($data){
                    return Assetmodels::findOne(['id'=>$data->modelID])->name;
                }
            ],
            'name',
            'tag_number',
            // [
            //     'label' => 'Storage',
            //     'value' => function ($data){
            //         return Storage::findOne(['id'=>$data->storageID])->name;
            //     }
            // ],
            // [
            //     'label' => 'RAM',
            //     'value' => function ($data){
            //         return Ram::findOne(['id'=>$data->ramID])->name;
            //     }
            // ],
            // [
            //     'label' => 'Operating System',
            //     'value' => function ($data){
            //         return Operatingsystem::findOne(['id'=>$data->osID])->name;
            //     }
            // ],
            [
                'label' => 'Location',
                'value' => function ($data){
                    return Locations::findOne(['id'=>$data->locationID])->name;
                }
            ],
            [
                'label' => 'Asset Status',
                'value' => function ($data){
                    return Assetstatus::findOne(['id'=>$data->assetstatus])->name;
                }
            ],
            'assetcondition',         
            [
                'label' => 'Created By',
                'attribute' => 'createdBy.displayname'
            ],
            'created_at:datetime',
            [
                'label' => 'Updated By',
                'attribute' => 'updatedBy.displayname'
            ],
            'updated_at:datetime',
            
        ],
    ]) ?>

<?= TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'Asset Specs',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'content' => GridView::widget([
                'dataProvider' => $assetspecifications,
                // 'filterModel' => $searchModel,
                'columns' => [
                    // ['class' => 'yii\grid\SerialColumn'],
                      
                    [
                        'label' => 'Storage',
                        'attribute' => 'storage.name'
                    ],
                    [
                        'label' => 'RAM',
                        'attribute' => 'ram.name'
                    ],
                    [
                        'label' => 'Operating System',
                        'attribute' => 'os.name'
                    ],
                ],
            ]),
            'active' => true
        ],

        [
            'label' => 'Accessories',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'content' => GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                      
                    [
                        'label' => 'Accessory',
                        'attribute' => 'accessorylist.name'
                    ],
                    [
                        'label' => 'Model or part Number',
                        'attribute' => 'accessorylist.model_or_part_number'
                    ],
                    
                ],
            ]),
            
        ], 

        [
            'label' => 'Asset History',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'content' => GridView::widget([
                'dataProvider' => $assettransactions,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                      
                    [
                        'label' => 'Transaction Code',
                        'attribute' => 'code'
                    ],
                    [
                        'label' => 'Transaction Type',
                        'attribute' => 'type'
                    ],
                    [
                        'label' => 'User Assigned',
                        'attribute' => 'user_assigned'
                    ],
                    [
                        'label' => 'Date',
                        'attribute' => 'transdate'
                    ],
                    [
                        'label' => 'Transacted By',
                        'attribute' => 'user_creator'
                    ],
                    
                ],
            ]),
            
        ], 
    ],
    ]) ?>

</div>

<?php

use common\models\Assetaccessories;
use common\models\Assetcategories;
use common\models\Assetmakes;
use common\models\Assetmodels;
use common\models\Ictassets;
use common\models\Locations;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Ictassets $model */

$this->title = $model->name;
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
            'storage',
            'ram',
            'operating_system',
            'date_of_delivery',
            [
                'label' => 'LocationID',
                'value' => function ($data){
                    return Locations::findOne(['id'=>$data->locationID])->name;
                }
            ],
            'assetstatus',
            'assetcondition',
            'created_at:datetime',
            'updated_at:datetime',
            'createdBy.username',
            'updatedBy.username',
        ],
    ]) ?>

<div class="panel-heading"><h4><i class="fa fa-tasks"></i> Accessories:</h4></div>

<div class="card">
    <?php foreach ($modelsAssetaccessories as $modelAssetaccessories):?>
    <?= DetailView::widget([
        'model' => $modelAssetaccessories,
        'attributes' => [
            // 'assetID',
            'code',
            'name',
            'description:html',
        ],
    ]) ?>
    <?php endforeach; ?>
    </div>

</div>

<?php

use common\models\Assetcategories;
use common\models\Assetmodels;
use common\models\Ictassets;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Surrenders $model */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Surrenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="surrenders-view">

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
                'label' => 'Transaction Ref',
                'attribute' => 'code'
            ],
            [
                'label' => 'Surrender Date',
                'attribute' => 'surrenderdate',
                'format' => ['date', 'php:d/M/Y'],
            ],
            [
                'label' => 'Category',
                'value' => function ($data){
                    return Assetcategories::findOne(['id'=>$data->categoryID])->name;
                }
            ],
            [
                'label' => 'Model',
                'value' => function ($data){
                    return Assetmodels::findOne(['id'=>$data->modelID])->name;
                }
            ],
            [
                'label' => 'Serial Number',
                'value' => function ($data){
                    return Ictassets::findOne(['id'=>$data->serialnumber])->name;
                }
            ],
            [
                'attribute' => 'accessorylistID',
                'value' => $model->getAccessoryListNames(),
            ],
            [
                'label' => 'User Allocated',
                'attribute' => 'user.displayName'
            ],
            'comments',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'label' => 'Surrendered by',
                'attribute' => 'createdBy.displayName'
            ],
            [
                'label' => 'Updated by',
                'attribute' => 'updatedBy.displayName'
            ],
        ],
    ]) ?>

</div>

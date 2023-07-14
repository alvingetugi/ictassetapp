<?php

use common\models\Category;
use common\models\Make;
use common\models\Models;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Asset $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asset-view">

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
            'id',
            'code',
            [
                'label' => 'Category',
                'value' => function ($data){
                    return Category::findOne(['id'=>$data->category])->name;
                }
            ],
            [
                'label' => 'Make',
                'value' => function ($data){
                    return Make::findOne(['id'=>$data->make])->name;
                }
            ],
            [
                'label' => 'Model',
                'value' => function ($data){
                    return Models::findOne(['id'=>$data->model])->name;
                }
            ],
            'name',
            'serial_number',
            'tag_number',
            'details',
            'date_of_delivery',
            'location',
            'status',
            'condition',
        ],
    ]) ?>

</div>

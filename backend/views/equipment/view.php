<?php

use common\models\Category;
use common\models\Equipmentmodel;
use common\models\Location;
use common\models\Make;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Equipment $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Equipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="equipment-view">

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
                    return Category::findOne(['id'=>$data->category_id])->name;
                }
            ],
            [
                'label' => 'Make',
                'value' => function ($data){
                    return Make::findOne(['id'=>$data->make_id])->name;
                }
            ],
            [
                'label' => 'Model',
                'value' => function ($data){
                    return Equipmentmodel::findOne(['id'=>$data->equipmodel_id])->name;
                }
            ],
            'name',
            'serial_number',
            'tag_number',
            'details',
            // 'date_of_delivery',

            [
                'attribute' => 'date_of_delivery',
                'format' => [ 'date', 'php: d-M-Y' ],
                'labelColOptions' => [ 'style'=>'width:30%; text-align:right;' ]
            ],

            [
                'label' => 'Location',
                'value' => function ($data){
                    return Location::findOne(['id'=>$data->location_id])->name;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => fn() => Html::tag('span', $model->status ? 'Active' : 'Retired', [
                    'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                ]),
            ],
            [
                'attribute' => 'condition',
                'format' => 'html',
                'value' => fn() => Html::tag('span', $model->condition ? 'Yes' : 'No', [
                    'class' => $model->condition ? 'badge badge-success' : 'badge badge-danger'
                ]),
            ],
        ],
    ]) ?>

</div>

<?php

use common\models\Category;
use common\models\Make;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Equipmentmodel $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Equipmentmodels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="equipmentmodel-view">

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
            'name',
            [
                'label' => 'Category',
                'value' => function ($data){
                    return Category::findOne(['id'=>$data->category_id])->name;
                }
            ],
            [
                'label' => 'Make/Brand',
                'value' => function ($data){
                    return Make::findOne(['id'=>$data->make_id])->name;
                }
            ],
        ],
    ]) ?>

</div>

<?php

use common\models\Assetcategories;
use common\models\Assetmakes;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Assetmodels $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Assetmodels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="assetmodels-view">

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
            'name',
            'description',
        ],
    ]) ?>

</div>

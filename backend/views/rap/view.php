<?php

use common\models\Raptypes;
use common\models\Schemes;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Rap $model */

$this->title = 'Remedial Action Plan: '. $model->id;
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
            'start',
            'end',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

</div>

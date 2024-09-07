<?php

use common\models\Rap;
use common\models\Rapscheduletypes;
use kartik\tabs\TabsX;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Rapschedules $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rapschedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rapschedules-view">

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
                'label' => 'Remedial Action Plan',
                'value' => function ($data){
                    return Rap::findOne(['id'=>$data->rapID])->name;
                }
            ],
            [
                'label' => 'Schedule Type',
                'value' => function ($data){
                    return Rapscheduletypes::findOne(['id'=>$data->rapscheduletypeID])->name;
                }
            ],
            'name',
            'duedate',
            'expectedamount',
            'comments',
        ],
    ]) ?>

<?= TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'Schedule Statement',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'content' => GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                           
                    [
                        'label' => 'Date',
                        'attribute' => 'paymentdate'
                    ],
                    [
                        'label' => 'Description',
                        'attribute' => 'comments'
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
                        'attribute' => 'runningbalance'
                    ],
                ],
            ]),
            'active' => true
        ],    

    ],
    ]) ?>


</div>

<?php

use common\models\Equipment;
use common\models\Location;
use common\models\Transactiontype;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Transaction $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transaction-view">

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
            'date',
            [
                'label' => 'Transaction Type',
                'value' => function ($data){
                    return Transactiontype::findOne(['id'=>$data->transaction_type])->type;
                }
            ],
            'staff',
            [
                'label' => 'Location',
                'value' => function ($data){
                    return Location::findOne(['id'=>$data->location_id])->name;
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'createdBy.username',
            'updatedBy.username',
        ],
    ]) ?>
<div class="panel-heading"><h4><i class="fa fa-tasks"></i> Details</h4></div>

<div class="card">
<?php foreach ($modelsTransactionDetail as $modelTransactionDetail):?>
<?= DetailView::widget([
        'model' => $modelTransactionDetail,
        'attributes' => [
            // 'trans_id',
            [
                'label' => 'Asset',
                'value' => function ($data){
                    return Equipment::findOne(['id'=>$data->equipment_id])->name;
                }
            ],
            'details:html',
        ],
    ]) ?>
<?php endforeach; ?>
    </div>
</div>

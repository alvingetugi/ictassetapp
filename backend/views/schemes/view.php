<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Schemes $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Schemes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="schemes-view">

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
            'ref',
            'type',
            'name',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

<div class="row" style="overflow: scroll">
    <table class="table" >
        <tr>
            <th>RAP ID</th>
            <th>RAP Type</th>       
            <th>RAP status</th> 
            <th>RAP Amount</th> 
            <th>RAP Start</th>   
            <th>Total Commitments</th>  
        </tr>
    <?php foreach ($schemeraps as $schemerap): ?>
        <tr>
            <td>
                <p><?= $schemerap['rap_id'] ?> </p>
            </td>
            <td>
                <p><?= $schemerap['typeID'] ?> </p>
            </td>
            <td>
                <p><?= $schemerap['status'] ?> </p>
            </td>
            <td>
                <p><?= $schemerap['amount'] ?> </p>
            </td>
            <td>
                <p><?= $schemerap['start'] ?> </p>
            </td>
            <td>
                <p><?= $schemerap['expectedamount'] ?> </p>
            </td>
        </tr>

    <?php endforeach; ?>
    </table>
</div>

</div>
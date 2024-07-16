<?php

use common\models\Plantypes;
use common\models\Schemes;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Remedialactionplans $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Remedialactionplans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="remedialactionplans-view">

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
            'rapref',
            [
                'label' => 'Scheme Name',
                'value' => function ($data){
                    return Schemes::findOne(['ref'=>$data->schemeID])->name;
                }
            ],
            [
                'label' => 'Plan Type',
                'value' => function ($data){
                    return Schemes::findOne(['ref'=>$data->type])->name;
                }
            ],
            'deficit',
            'planstart',
            'frequency',
            'installmentamount',
            'planend',
            'comments',
            'runningbalance',
            'created_at:datetime',
            'updated_at:datetime',
            'createdBy.username',
            'updatedBy.username',
        ],
    ]) ?>

</div>

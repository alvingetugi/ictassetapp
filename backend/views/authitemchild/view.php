<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Authitemchild $model */

$this->title = $model->child;
$this->params['breadcrumbs'][] = ['label' => 'Authitemchildren', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="authitemchild-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'child' => $model->child, 'parent' => $model->parent], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'child' => $model->child, 'parent' => $model->parent], [
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
            'parent',
            'child',
        ],
    ]) ?>

</div>

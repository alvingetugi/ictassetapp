<?php

use common\models\Departments;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->firstname . " " . $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

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
            // 'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            ['attribute'=>'status','value'=>function($model){
                if($model->status == 0)
                        {
                        return 'Deleted';
                        } 
                        else if ($model->status == 9){
                            return 'Inactive';
                        }
                        else if ($model->status == 10){
                            return 'Active';
                        }                        
                        else {
                        return 'No Status';
                        }
            }],
            // 'created_at',
            // 'updated_at',
            // 'verification_token',
            'firstname',
            'lastname',
             ['attribute'=>'department', 'value'=> function($data){
                if($data->department === null)
                        {
                        return 'No Department';
                        } 
                        else {
                        return Departments::findOne(['id'=>$data->department])->name;
                        }
            }],
        ],
    ]) ?>

</div>

<?php

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
             ['attribute'=>'department','value'=>function($model){
                if($model->department == 1)
                        {
                        return 'Finance and Accounts';
                        } 
                        else if ($model->department == 2){
                            return 'Internal Audit and Risk Assurance';
                        }
                        else if ($model->department == 3){
                            return 'Corporation Secretary and Legal Services';
                        }
                        else if ($model->department == 4){
                            return 'Information and Communication Technology';
                        }
                        else if ($model->department == 5){
                            return 'Market Conduct and Industry Development';
                        }
                        else if ($model->department == 6){
                            return 'Supervision';
                        }
                        else if ($model->department == 7){
                            return 'Corporate Communications';
                        }
                        else if ($model->department == 8){
                            return 'Procurement and Supply Chain';
                        }
                        else if ($model->department == 9){
                            return 'Human Resource and Administration';
                        }
                        else if ($model->department == 10){
                            return 'Research, Strategy and Planning';
                        }
                        else if ($model->department == 11){
                            return 'Executive';
                        }
                        else if ($model->department == 12){
                            return 'Management Representative';
                        }
                        else if ($model->department == 13){
                            return 'Tribunal';
                        }
                        else if ($model->department == 13){
                            return 'Board';
                        }
                        else {
                        return 'No Department';
                        }
            }],
        ],
    ]) ?>

</div>

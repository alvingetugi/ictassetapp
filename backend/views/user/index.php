<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel, 'pageSize' => $pageSize]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'username',
            'firstname',
            'lastname',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            // 'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            //'firstname',
            //'lastname',
            [
                'attribute' => 'department',
                'value' => 'departments.name',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {assign-roles}',
                'header' => 'Actions',  // Optional header
                'contentOptions' => ['style' => 'white-space: nowrap;'],  // Ensure buttons are in a single line
                'headerOptions' => ['style' => 'white-space: nowrap;'],  // Optional, makes header aligned
                'buttons' => [
                    'view' => function ($url, $model) {
                            return (Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']));
                    },
                    'assign-roles' => function ($url, $model, $key) {
                        return Html::a('Roles', 
                            ['user/assignroles', 'id' => $model->id], 
                            [
                                'title' => Yii::t('app', 'Assign Roles'),
                                'class' => 'btn btn-primary',
                                'aria-label' => Yii::t('app', 'Assign Roles'),
                                'data-pjax' => '0', // Prevent PJAX from refreshing the grid
                            ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>

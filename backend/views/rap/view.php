<?php

use common\models\Raptypes;
use common\models\Schemes;
use kartik\tabs\TabsX;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Rap $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Raps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$js = <<<JS
    // Reset modal form when closed
    $('#importModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
    });
JS;
$this->registerJs($js);

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
            // 'name',
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
            'startdate',
            'enddate',
            'comments',
            [
                'attribute' => 'rapdocument',
                'format' => ['html'],
                'value' => fn() => Html::a('Download', [
                    'rap/pdf',
                    'id' => $model->id,
                ], [
                    'class' => 'btn btn-primary',
                    'target' => '_blank',
                ]),
            ],
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

<div class="site-import">

<!-- Button to trigger modal -->
<?= Html::button('Import Schedules', [
    'class' => 'btn btn-info float-right',
    'data-toggle' => 'modal',
    'data-target' => '#importModal'
]) ?>

<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Upload Excel File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'action' => ['rap/import', 'id' => $model->id], // Include the ID in the action
                    'options' => ['enctype' => 'multipart/form-data']
                ]); ?>

                <?= $form->field($model, 'file')->fileInput()->label('Choose Excel File') ?>

                <div class="form-group">
                    <?= Html::submitButton('Import', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
</div>

<?= TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'Schedules',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'content' => GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                      
                    [
                        'label' => 'Date',
                        'attribute' => 'transdate'
                    ],
                    [
                        'label' => 'Description',
                        'attribute' => 'ref'
                    ],
                    [
                        'label' => 'Debit',
                        'attribute' => 'debit'
                    ],
                    [
                        'label' => 'Credit',
                        'attribute' => 'credit'
                    ],
                    // [
                    //     'label' => 'Previous Balance',
                    //     'attribute' => 'openningbalance'
                    // ],
                    [
                        'label' => 'Closing Balance',
                        'attribute' => 'closingbalance'
                    ],
                ],
            ]),
            'active' => true
        ], 
        
        [
            'label' => 'Statement',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'content' => GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                      
                    [
                        'label' => 'Date',
                        'attribute' => 'transdate'
                    ],
                    [
                        'label' => 'Description',
                        'attribute' => 'ref'
                    ],
                    [
                        'label' => 'Debit',
                        'attribute' => 'debit'
                    ],
                    [
                        'label' => 'Credit',
                        'attribute' => 'credit'
                    ],
                    // [
                    //     'label' => 'Previous Balance',
                    //     'attribute' => 'openningbalance'
                    // ],
                    [
                        'label' => 'Closing Balance',
                        'attribute' => 'closingbalance'
                    ],
                ],
            ]),
        ],

    ],
    ]) ?>

</div>

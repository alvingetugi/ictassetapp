<?php

use common\models\Ictassets;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\IctassetsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ICT Assets';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    $(document).on('click', '.issue-button', function() {
        var recordId = $(this).data('id'); // Get the ID of the related record
        
        // Show the modal
        $('#issuance-modal').modal('show');
        
        // Send AJAX request to fetch serial number data
        $.ajax({
            url: '" . Url::to(['ictassets/getserialnumber']) . "', // Replace with actual controller action
            type: 'GET',
            data: { id: recordId }, // Pass the ID to the controller
            success: function(response) {
                if (response.success) {
                    // Populate the serial number field in the modal's form
                    $('#serial_number_field').val(response.serial_number);
                } else {
                    alert('Failed to fetch serial number');
                }
            },
            error: function() {
                alert('Error in AJAX request');
            }
        });
    });
", \yii\web\View::POS_READY);

$this->registerJs("
    $(document).on('submit', '#issuance-form', function(e) {
        e.preventDefault(); // Prevent normal form submission

        // Send form data via AJAX
        $.ajax({
            url: '" . Url::to(['isuances/create']) . "', // Replace with the actual issue action
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    alert('Serial number issued successfully');
                    $('#issuance-modal').modal('hide'); // Close the modal
                } else {
                    alert('Failed to issue serial number');
                }
            },
            error: function() {
                alert('Error in form submission');
            }
        });
    });
", \yii\web\View::POS_READY);


Modal::begin([
    'id' => 'issuance-modal',
   
    'size' => 'modal-lg',
]);

// The form for issuing a serial number
echo Html::beginForm('', 'post', ['id' => 'issuances-form']);
echo Html::input('text', 'serial_number', '', ['id' => 'serial_number_field', 'class' => 'form-control', 'readonly' => true]);

echo Html::submitButton('Issue', ['class' => 'btn btn-primary']);
echo Html::endForm();

Modal::end();

?>
<div class="ictassets-index">



    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'code',
            [
                'attribute' => 'categoryID',
                'value' => 'category.name'
            ],
            // [
            //     'attribute' => 'makeID',
            //     'value' => 'make.name'
            // ],
            [
                'attribute' => 'modelID',
                'value' => 'model.name'
            ],
            'name',
            'tag_number',
            //'storageID',
            //'ramID',
            //'osID',
            //'locationID',
            [
                'attribute' => 'assetstatus',
                'value' => 'assetStatus.name'
            ],
            //'assetcondition',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'template' => '{view}',
            //     'buttons' => [
            //         'view' => function ($url, $model) {
            //                 return (Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']));
            //         },
            //     ],
            // ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'issue' => function ($url, $model, $key) {
                        // Check if status is 1 to show the "Surrender" button
                        if ($model->assetstatus == 1) {
                            return Html::a('Issue', '#', [
                                'class' => 'btn btn-warning issue-button',
                                'data-id' => $model->id, // Pass the record ID
                            ]);
                        }
                    },
                    'surrender' => function ($url, $model, $key) {
                        // Check if status is 2 to show the "Issue" button
                        if ($model->assetstatus == 2) {
                            return Html::a('Return', $url, [
                                'class' => 'btn btn-success',
                                'title' => 'Return',
                            ]);
                        }
                    },
                    'view' => function ($url, $model) {
                        return (Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']));
                    },
                ],
                'template' => '{issue} {surrender} {view}', // Adjust buttons layout
                'header' => 'Actions',  // Optional header
                'contentOptions' => ['style' => 'white-space: nowrap;'],  // Ensure buttons are in a single line
                'headerOptions' => ['style' => 'white-space: nowrap;'],  // Optional, makes header aligned
            ],
        ],
    ]); ?>


</div>

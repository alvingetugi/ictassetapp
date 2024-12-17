<?php

use common\models\Accessorylist;
use common\models\Ictassets;
use common\models\User;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\IctassetsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ICT Assets';
$this->params['breadcrumbs'][] = $this->title;

$script = <<<JS
// When the Issuance modal button is clicked
$('.issue-asset').click(function () {
    var issuancecategoryID = $(this).data('issuancecategory');
    var issuancemodelID = $(this).data('issuancemodel');
    var issuanceserialnumber = $(this).data('issuanceserial');
    var issuancecategoryname = $(this).data('issuancecategoryname');
    var issuancemodelname = $(this).data('issuancemodelname');
    var issuanceserialname = $(this).data('issuanceserialnumber');
    var issuanceTitle = 'Issuance for: ' + issuancemodelname + ' ' + 'with serial number' + ' ' + issuanceserialname;

    // Send an AJAX request to fetch the form data
    $.ajax({
        url: $(this).attr('value'), // URL to load the form fields
        type: 'GET',
        data: {
            issuanceserialnumberID: issuanceserialnumber // Pass the Asset ID to bind it to its serial to the controller
        },
        success: function (response) {
            $('#issuance-modal-content').html(response); // Insert the form into the modal
            $('#issuancemodal .modal-title').text(issuanceTitle);
            $('#issuancemodal').modal('show'); // Show the modal

            // Pre-populate the form fields
            $('#issuance-form-categoryID').val(issuancecategoryID); // Populate categoryID field
            $('#issuance-form-modelID').val(issuancemodelID); // Populate modelID field
            $('#issuance-form-serialnumber').val(issuanceserialnumber); // Populate serialNumber field
           
        }
    });
});

// When the Surrender modal button is clicked
$('.surrender-asset').click(function () {
    var surrendercategoryID = $(this).data('surrendercategory');
    var surrendermodelID = $(this).data('surrendermodel');
    var surrenderserialnumber = $(this).data('surrenderserial');
    var surrendercategoryname = $(this).data('surrendercategoryname');
    var surrendermodelname = $(this).data('surrendermodelname');
    var surrenderserialname = $(this).data('surrenderserialnumber');
    var surrenderTitle = 'Surrender for: ' + surrendermodelname + ' ' + 'with serial number' + ' ' + surrenderserialname;

    // Send an AJAX request to fetch the form data
    $.ajax({
        url: $(this).attr('value'), // URL to load the form fields
        type: 'GET',
        data: {
            surrenderserialnumberID: surrenderserialnumber // Pass the Asset ID to bind it to its serial to the controller
        },
        success: function (response) {
            $('#surrender-modal-content').html(response); // Insert the form into the modal
            $('#surrendermodal .modal-title').text(surrenderTitle);
            $('#surrendermodal').modal('show'); // Show the modal

            // Pre-populate the form fields
            $('#surrender-form-categoryID').val(surrendercategoryID); // Populate categoryID field
            $('#surrender-form-modelID').val(surrendermodelID); // Populate modelID field
            $('#surrender-form-serialnumber').val(surrenderserialnumber); // Populate serialNumber field
        }
    });
});
JS;
$this->registerJs($script);

Modal::begin([
    'id' => 'issuancemodal',
    'title' => 'Issuance Form',
    'size' => 'modal-lg',
]);

echo '<div id="issuance-modal-content">
</div>';

Modal::end();

Modal::begin([
    'id' => 'surrendermodal',
    'title' => 'Surrender Form',
    'size' => 'modal-lg',
]);

echo '<div id="surrender-modal-content"></div>';

Modal::end();

?>
<div class="ictassets-index">



    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="table-responsive">
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
            // [
            //     'attribute' => 'assetstatus',
            //     'value' => 'assetStatus.name'
            // ],
            [
                'attribute' => 'assetstatus',  // Attribute to check the status
                'label' => 'Asset Status',
                'format' => 'raw',  // Important: ensure raw format for HTML rendering
                'value' => function($model) {
                    // Check the asset's status
                    if ($model->assetstatus == 1) {
                        // If status is 1, show "New" with a green badge
                        return Html::tag('span', 'New', [
                            'class' => 'badge badge-success', // Bootstrap class for green badge
                        ]);
                    } elseif ($model->assetstatus == 2) {
                        // If status is 2, show "Issued" with a red badge
                        return Html::tag('span', 'Issued', [
                            'class' => 'badge badge-warning', // Bootstrap class for red badge
                        ]);
                    } else {
                        // If neither 1 or 2, show "Surrendered" with a grey badge
                        return Html::tag('span', 'Surrendered', [
                            'class' => 'badge badge-secondary', // Bootstrap class for gray badge
                        ]);
                    }
                },
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
                        if ($model->assetstatus == 1 || $model->assetstatus == 3) {
                            return Html::a('Issue', '#', [
                                'class' => 'btn btn-warning issue-asset',
                                'value' => Url::to(['/issuances/createwithmodal', 'id' => $model->id]),
                                'data-issuancecategory' => $model->categoryID,
                                'data-issuancemodel' => $model->modelID,
                                'data-issuanceserial' => $model->id,
                                'data-issuancecategoryname' => $model->categoryID ? $model->category->name : 'Unknown Category',
                                'data-issuancemodelname' => $model->modelID ? $model->model->name : 'Unknown Model',
                                'data-issuanceserialnumber' => $model->name,
                            ]);
                        }
                    },
                    'surrender' => function ($url, $model, $key) {
                        // Check if status is 1 to show the "Surrender" button
                        if ($model->assetstatus == 2) {
                            return Html::a('Surrender', '#', [
                                'class' => 'btn btn-success surrender-asset',
                                'value' => Url::to(['/surrenders/createwithmodal', 'id' => $model->id]),
                                'data-surrendercategory' => $model->categoryID,
                                'data-surrendermodel' => $model->modelID,
                                'data-surrenderserial' => $model->id,
                                'data-surrendercategoryname' => $model->categoryID ? $model->category->name : 'Unknown Category',
                                'data-surrendermodelname' => $model->modelID ? $model->model->name : 'Unknown Model',
                                'data-surrenderserialnumber' => $model->name,
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


</div>

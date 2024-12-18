<?php

namespace backend\controllers;

use common\models\Issuances;
use common\models\Surrenders;
use Yii;
use common\models\Assetaccessories;
use common\models\Assetmakes;
use common\models\Assetmodels;
use common\models\Ictassets;
use backend\models\search\IctassetsSearch;
use yii\db\Exception;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * IctassetsController implements the CRUD actions for Ictassets model.
 */
class IctassetsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Ictassets models.
     * @return mixed
     */
    public function actionIndex($pageSize = 10)
    {
        $searchModel = new IctassetsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, $pageSize);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pageSize' => $pageSize,
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelsAssetaccessories = $model->assetaccessories;

        // Get all accessories
        $query = new Query();        
        $query = Assetaccessories::find()
         ->select('assetaccessories.*')
         ->leftJoin('accessorylist', 'accessorylist.id = assetaccessories.accessorylistID')
         ->where(['assetaccessories.assetID' => $id])
         ->with('accessorylist');

         // Get all Assets with their specifications
         $assets = new Query();        
         $assets = Ictassets::find()
         ->select('ictassets.*')
         ->leftJoin('storage', 'storage.id = ictassets.storageID')
         ->leftJoin('ram', 'ram.id = ictassets.ramID')
         ->leftJoin('operatingsystem', 'operatingsystem.id = ictassets.osID')
         ->where(['ictassets.id' => $id])
         ->with('storage')
         ->with('ram')
         ->with('os');

         // Get all Issuances
         $issuances = (new Query())
            ->select([
                'issuances.id AS transactionID',
                'issuances.code',
                'issuances.serialnumber AS serialnumber',
                'issuances.userID',
                'issuances.issuancedate AS transdate',
                'issuances.created_by',
                'ictassets.id AS assetID',
            ])
            ->from('issuances')
            ->join('INNER JOIN', 'ictassets', 'issuances.serialnumber = ictassets.id');

        // Get all Surrenders
        $surrenders = (new Query())
        ->select([
            'surrenders.id AS transactionID',
            'surrenders.code AS code',
            'surrenders.serialnumber AS serialnumber',
            'surrenders.userID',
            'surrenders.surrenderdate AS transdate',
            'surrenders.created_by',
            'ictassets.id AS assetID',
        ])
        ->from('surrenders')
        ->join('INNER JOIN', 'ictassets', 'surrenders.serialnumber = ictassets.id');

        //Merge all transactions
        $unionquery = (new Query())
        ->from(['transactions' => $issuances->union($surrenders)]);

        //Assign transaction types to all transactions
        $transwithtypes = (new Query())
        ->select([
            'transactionID',
            'code',
            new Expression("CASE WHEN code LIKE '%ISS%' THEN 'Issuance'        
                            WHEN code LIKE '%SUR%' THEN 'Surrender'
                            ELSE 'No Type'
                            END AS type"),
            'serialnumber',
            'userID',
            'transdate',
            'created_by',
            'assetID'
            
        ])
        ->from(['unionquery' => $unionquery]);

        //Query All Transactions
        $transactions = (new Query())
        ->select([
            'transwithtypes.transactionID',
            'transwithtypes.code',
            'transwithtypes.type',
            'transwithtypes.serialnumber',
            'transwithtypes.userID',
            'transwithtypes.transdate',
            'transwithtypes.created_by',
            'transwithtypes.assetID',
            new Expression("CONCAT(creator.firstname, ' ', creator.lastname) AS user_creator"),
            new Expression("CONCAT(staff.firstname, ' ', staff.lastname) AS user_assigned")
            
        ])
        ->from(['transwithtypes' => $transwithtypes])
        ->leftJoin('[user] AS creator', 'creator.id = transwithtypes.created_by')
        ->leftJoin('[user] AS staff', 'staff.id = transwithtypes.userID')
        ->where(['assetID' => $id]); 

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        $assetspecifications = new ActiveDataProvider([
            'query' => $assets,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        $assettransactions = new ActiveDataProvider([
            'query' => $transactions,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('view', [
            'model' => $model,
            'modelsAssetaccessories' => $modelsAssetaccessories,
            'dataProvider' => $dataProvider,
            'assetspecifications' => $assetspecifications,
            'assettransactions' => $assettransactions,
        ]);
    }

    /**
     * Creates a new Ict Assets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ictassets();
        $modelsAssetaccessories = [new Assetaccessories];

        if ($model->load(Yii::$app->request->post())) {

            $modelsAssetaccessories = Model::createMultiple(Assetaccessories::classname());
            Model::loadMultiple($modelsAssetaccessories, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsAssetaccessories) && $valid;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        $model->code = 'AST' . '-' . $model->model->code . '-' . $model->id;
                        $model->save();
                        foreach ($modelsAssetaccessories as $modelAssetaccessories) {
                            $modelAssetaccessories->assetID = $model->id;
                            $model->save();
                            if (!($flag = $modelAssetaccessories->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsAssetaccessories' => (empty($modelsAssetaccessories)) ? [new Assetaccessories] : $modelsAssetaccessories
            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsAssetaccessories = $model->assetaccessories;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsAssetaccessories, 'id', 'id');
            $modelsAssetaccessories = Model::createMultiple(Assetaccessories::classname(), $modelsAssetaccessories);
            Model::loadMultiple($modelsAssetaccessories, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAssetaccessories, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsAssetaccessories) && $valid;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            Assetaccessories::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsAssetaccessories as $modelAssetaccessories) {
                            $modelAssetaccessories->assetID = $model->id;
                            $model->save();
                            if (!($flag = $modelAssetaccessories->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsAssetaccessories' => (empty($modelsAssetaccessories)) ? [new Assetaccessories] : $modelsAssetaccessories
        ]);
    }

    /**
     * Deletes an existing Ictassets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ictassets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Ictassets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ictassets::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //Handles the dependency action for selecting a make
    public function actionMakes()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Assetmakes::getMakesList($cat_id, true);
                return json_encode(['output' => $out, 'selected' => '']);
            }
        }
        return json_encode(['output' => '', 'selected' => '']);
    }

    //Handles the dependency action for selecting a model
    public function actionModels()
    {

        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $model_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
                $out = Assetmodels::getModelsList($cat_id, $model_id, true);
                return json_encode(['output' => $out, 'selected' => '']);
            }
        }
        return json_encode(['output' => '', 'selected' => '']);
    }

    //Handles the dependency action for selecting a model for issuance
    public function actionModelissuances()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Assetmodels::getModelListissuance($cat_id, true);
                return json_encode(['output' => $out, 'selected' => '']);
            }
        }
        return json_encode(['output' => '', 'selected' => '']);
    }

    //Handles the dependency action for selecting a serial number
    public function actionSerialnumbers()
    {

        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $model_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
                $out = Ictassets::getSerialsList($cat_id, $model_id, true);
                return json_encode(['output' => $out, 'selected' => '']);
            }
        }
        return json_encode(['output' => '', 'selected' => '']);
    }

    //Handles the dependency action for selecting a serial number
    public function actionIssuedserials()
    {

        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $model_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
                $out = Ictassets::getIssuedAssets($cat_id, $model_id, true);
                return json_encode(['output' => $out, 'selected' => '']);
            }
        }
        return json_encode(['output' => '', 'selected' => '']);
    }

     //Handles the dependency action for selecting accessories attached to their relevant assets
     public function actionAccessorylist()
     {
 
         $out = [];

          // Check if 'depdrop_parents' is set in the POST request
         if (isset($_POST['depdrop_parents'])) {
             $ids = $_POST['depdrop_parents'];

             // Extract category_id, model_id, and serialnumber from parents
             $cat_id = empty($ids[0]) ? null : $ids[0];
             $model_id = empty($ids[1]) ? null : $ids[1];
             $serialnumber = empty($ids[2]) ? null : $ids[2];

             // Only proceed if category_id is provided
             if ($cat_id != null) {

                // Fetch accessories based on the provided filters
                 $out = Ictassets::getAccessoryList($cat_id, $model_id, $serialnumber, true);

                 // Format output for DepDrop (expects 'output' and 'selected' fields)
                // The 'output' is an array of items for the dropdown, and 'selected' is the default selection
                 return json_encode(['output' => $out, 'selected' => '']);
             }
         }

         // Return empty output if no parents or invalid data
         return json_encode(['output' => '', 'selected' => '']);
     }
}

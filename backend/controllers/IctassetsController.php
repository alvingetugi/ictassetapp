<?php

namespace backend\controllers;

use Yii;
use common\models\Assetaccessories;
use common\models\Assetmakes;
use common\models\Assetmodels;
use common\models\Ictassets;
use backend\models\search\IctassetsSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

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

        return $this->render('view', [
            'model' => $model,
            'modelsAssetaccessories' => $modelsAssetaccessories,
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
                        $model->assetstatus = 3;
                        $model->save();
                        foreach ($modelsAssetaccessories as $modelAssetaccessories) {
                            $modelAssetaccessories->assetID = $model->id;
                            $modelAssetaccessories->code = 'ACC' . '-' . $model->id;
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
                        if (! empty($deletedIDs)) {
                            Assetaccessories::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsAssetaccessories as $modelAssetaccessories) {
                            $modelAssetaccessories->assetID = $model->id;
                            $modelAssetaccessories->code = 'ACC' . '-' . $model->id;
                            $model->save();
                            if (! ($flag = $modelAssetaccessories->save(false))) {
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
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    //Handles the dependency action for selecting a make
    public function actionMakes() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Assetmakes::getMakesList($cat_id, true);
                return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }

    //Handles the dependency action for selecting a model
    public function actionModels() {
        
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $model_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
               $out = Assetmodels::getModelsList($cat_id, $model_id, true);            
               return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }

    //Handles the dependency action for selecting a model for issuance
    public function actionModelissuances() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Assetmodels::getModelListissuance($cat_id, true);
                return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }

    //Handles the dependency action for selecting a serial number
    public function actionSerialnumbers() {
        
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $model_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
               $out = Ictassets::getSerialsList($cat_id, $model_id, true);            
               return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }

    //Handles the dependency action for selecting a serial number
    public function actionIssuedserials() {
        
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $model_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
               $out = Ictassets::getIssuedAssets($cat_id, $model_id, true);            
               return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
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
}

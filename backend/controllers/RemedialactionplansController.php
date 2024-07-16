<?php

namespace backend\controllers;

use common\models\Frequency;
use common\models\Planledger;
use common\models\Plantypes;
use common\models\Schemes;
use Exception;
use Yii;
use common\models\Model;
use common\models\Remedialactionplans;
use backend\models\search\RemedialactionplansSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RemedialactionplansController implements the CRUD actions for Remedialactionplans model.
 */
class RemedialactionplansController extends Controller
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
     * Lists all Remedialactionplans models.
     *
     * @return string
     */
    public function actionIndex($pageSize = 10)
    {
        $searchModel = new RemedialactionplansSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pageSize' => $pageSize,
        ]);
    }

    /**
     * Displays a single Remedialactionplans model.
     * @param int $id ID
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelsPlanledger = $model->planledgers;

        return $this->render('view', [
            'model' => $model,
            'modelsPlanledger' => $modelsPlanledger,
        ]);
    }

    /**
     * Creates a new Remedial Action Plans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Remedialactionplans();
        $modelsPlanledger = [new Planledger];

        if ($model->load(Yii::$app->request->post())) {

            $modelsPlanledger = Model::createMultiple(Planledger::classname());
            $model::loadMultiple($modelsPlanledger, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = $model::validateMultiple($modelsPlanledger) && $valid;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        $model->rapref = 'RAP' . '-' . $model->id;
                        $model->save();
                        foreach ($modelsPlanledger as $modelPlanledger) {
                            $modelPlanledger->rapID = $model->id;
                            $model->save();
                            if (!($flag = $modelPlanledger->save(false))) {
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
            'schemes' => Schemes::find()->all(),
            'frequencies' => Frequency::find()->all(),
            'modelsPlanledger' => (empty($modelsPlanledger)) ? [new Planledger] : $modelsPlanledger
        ]);
    }
    }

    /**
     * Updates an existing Remedial Action Plan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsPlanledger = $model->planledgers;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsPlanledger, 'id', 'id');
            $modelsPlanledger = Model::createMultiple(Planledger::classname(), $modelsPlanledger);
            Model::loadMultiple($modelsPlanledger, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPlanledger, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPlanledger) && $valid;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Planledger::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPlanledger as $modelPlanledger) {
                            $modelPlanledger->rapID = $model->id;
                            $model->save();
                            if (! ($flag = $modelPlanledger->save(false))) {
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
            'schemes' => Schemes::find()->all(),
            'frequencies' => Frequency::find()->all(),
            'modelsPlanledger' => (empty($modelsPlanledger)) ? [new Planledger] : $modelsPlanledger
        ]);
    }

    /**
     * Deletes an existing Remedialactionplans model.
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
     * Finds the Remedialactionplans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Remedialactionplans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Remedialactionplans::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

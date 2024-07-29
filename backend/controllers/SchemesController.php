<?php

namespace backend\controllers;

use common\models\Rap;
use common\models\Schemes;
use backend\models\search\SchemesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SchemesController implements the CRUD actions for Schemes model.
 */
class SchemesController extends Controller
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
     * Lists all Schemes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SchemesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Schemes model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // $schemeraps = Rap::find()->all();  
        
    //    $schemeraps = Rap::findBySql("
    //                 SELECT 
    //                     r.id as rap_id, 
    //                     r.schemeID as scheme_id, 
    //                     r.typeID as typeID, 
    //                     r.status as status, 
    //                     r.amount as amount, 
    //                     r.start as start, 
    //                     sum(c.expectedamount) as expectedamount 
    //                 FROM rap r
    //                 LEFT JOIN rapcommitments c on r.id = c.rapID 
    //                 WHERE r.status=1
    //                 GROUP BY r.id, r.typeID, r.status, r.amount, r.start")
    //                 ->asArray()
    //                 ->all();

        $schemeraps = (new \yii\db\Query())
        ->select(['r.id AS rap_id', 'r.schemeID AS scheme_id', 'r.typeID AS typeID', 'r.status AS status', 'r.amount As amount', 'r.start as start', 'sum(c.expectedamount) AS expectedamount'])
        ->from(['rap r'])
        ->join('LEFT JOIN', 'rapcommitments c', 'r.id = c.rapID')
        ->where(['r.schemeID'=> $id])
        ->groupBy('r.id, r.schemeID, r.typeID, r.status, r.amount, r.start')
        ->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'schemeraps' => $schemeraps,
        ]);
    }

    /**
     * Creates a new Schemes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Schemes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Schemes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Schemes model.
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
     * Finds the Schemes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Schemes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schemes::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

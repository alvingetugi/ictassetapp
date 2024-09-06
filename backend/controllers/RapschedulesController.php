<?php

namespace backend\controllers;

use common\models\Rap;
use common\models\Rapschedules;
use backend\models\search\RapschedulesSearch;
use common\models\Schemes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Query;
Use yii\db\Expression;

/**
 * RapschedulesController implements the CRUD actions for Rapschedules model.
 */
class RapschedulesController extends Controller
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
     * Lists all Rapschedules models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RapschedulesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rapschedules model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // Get all raps with payments
        $scheduleswithpayments = (new Query())
         ->select([
          'rapschedules.id AS scheduleID',
          'rapschedules.duedate', 
          'rapschedules.expectedamount',
          'rappayments.paymentdate',
          'rappayments.amount',
          'rappayments.comments'
        ])
        ->from('rapschedules')
        ->join('INNER JOIN', 'rappayments', 'rapschedules.id = rappayments.scheduleID');

        // Get all schedules with their running balances
       $runningbalance = (new Query())
       ->select([
        'scheduleID',
        'duedate', 
        'paymentdate',
        new Expression("CASE WHEN ROW_NUMBER() OVER (PARTITION BY scheduleID ORDER BY paymentdate) = 1 THEN expectedamount 
                             WHEN comments = 'Interest' THEN +amount ELSE 0 END AS debits"),
        new Expression("CASE WHEN comments = 'Interest' THEN 0 ELSE +amount END AS credits"),
        new Expression("CASE WHEN ROW_NUMBER() OVER (PARTITION BY scheduleID ORDER BY paymentdate) = 1 THEN 'Openning Balance' 
                             WHEN paymentdate > duedate THEN 'Overdue Payment'
                             ELSE comments END AS comments"),
        new Expression("expectedamount + SUM(CASE WHEN comments = 'Payment' THEN -amount WHEN comments = 'Interest' THEN +amount ELSE 0 END) OVER (PARTITION BY scheduleID ORDER BY paymentdate) AS runningbalance")
    ])
    ->from(['scheduleswithpayments' => $scheduleswithpayments]);
     
     $query = (new Query())
     ->select([
        'scheduleID',
        'duedate', 
        'paymentdate',
        'debits',
        'credits',
        'comments',
        'runningbalance'
    ])
    ->from(['runningbalance' => $runningbalance])
    ->where(['scheduleID'=> $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Rapschedules model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Rapschedules();      

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $rap = Rap::find()->where(['id'=>$model->rapID])->one();
                $model->name = 'SCHDL' . '-' . $model->id . '-' . $rap->name;
                $model->save();
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
     * Updates an existing Rapschedules model.
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
     * Deletes an existing Rapschedules model.
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
     * Finds the Rapschedules model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Rapschedules the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rapschedules::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace backend\controllers;

use common\models\Rap;
use common\models\Rapreport;
use common\models\Rapsbypayments;
use common\models\Schemes;
use backend\models\search\SchemesSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
Use yii\db\Expression;
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

        // Get all raps
        $raps = (new Query())
         ->select([
          'rap.id as rapID', 
          'rap.schemeID',
          'rap.name AS rapref', 
          'raptypes.name AS raptype', 
          new Expression("CASE WHEN rap.status = 1 THEN 'Active' ELSE 'Inactive' END AS rapstatus"),
          'rap.amount AS deficit', 
          'rap.startdate', 
          'rap.enddate'
        ])
        ->from('raptypes')
        ->join('INNER JOIN', 'rap', 'raptypes.id = rap.typeID');

       // Get all raps with their schedules
       $schedules = (new Query())
       ->select([
        'raps.rapID',
        'raps.schemeID',
        'raps.rapref',
        'raps.raptype',
        'raps.rapstatus',
        'raps.deficit',
        'raps.startdate',
        'raps.enddate',
        new Expression('SUM(ISNULL(rapschedules.expectedamount, 0)) AS expectedamount')
      ])
      ->from(['raps' => $raps])
      ->join('RIGHT JOIN', 'rapschedules', 'raps.rapID = rapschedules.rapID')
      ->groupBy(['raps.rapID', 'raps.schemeID', 'raps.rapref', 'raps.raptype', 'raps.rapstatus', 'raps.deficit', 'raps.startdate', 'raps.enddate']);

     // Get all raps with their payments
     $payments = (new Query())
     ->select([
      'schedules.rapID',
      'schedules.schemeID',
      'schedules.rapref',
      'schedules.raptype',
      'schedules.rapstatus',
      'schedules.deficit',
      'schedules.startdate',
      'schedules.enddate',
      'schedules.enddate',
      'schedules.expectedamount',
      new Expression('SUM(ISNULL(rappayments.amount, 0)) AS totalpayments')
    ])
    ->from(['schedules' => $schedules])
    ->join('FULL OUTER JOIN', 'rappayments', 'rappayments.rapID = schedules.rapID')
    ->groupBy(['schedules.rapID', 'schedules.schemeID', 'schedules.rapref', 'schedules.raptype', 'schedules.rapstatus', 'schedules.deficit', 'schedules.startdate', 'schedules.enddate', 'schedules.expectedamount']);

    // Get a full report
    $query = (new Query())
    ->select([
     'rapID',
     'schemeID',
     'rapref',
     'raptype',
     'rapstatus',
     new Expression("FORMAT(deficit, 'N', 'en-us') AS deficit"),
     'startdate',
     'enddate',
     new Expression("FORMAT(expectedamount, 'N', 'en-us') AS expectedamount"),
     new Expression("FORMAT(totalpayments, 'N', 'en-us') AS totalpayments"),
     new Expression("FORMAT(deficit - totalpayments, 'N', 'en-us') AS balance")
   ])
   ->from(['payments' => $payments])
   ->where(['schemeID'=> $id]);

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

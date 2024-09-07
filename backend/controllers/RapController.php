<?php

namespace backend\controllers;

use yii\web\UploadedFile;
use Yii;
use common\models\Rap;
use backend\models\search\RapSearch;
use common\models\Schemes;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Query;
Use yii\db\Expression;

/**
 * RapController implements the CRUD actions for Rap model.
 */
class RapController extends Controller
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
     * Lists all Rap models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RapSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rap model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

         // Get all schedule amounts
        $schedules = (new Query())
        ->select([
         'rapschedules.id', 
         'rapschedules.rapID AS schedulerapID',
         'rapschedules.rapscheduletypeID AS scheduletypeID',
         'rapschedules.duedate',
         'rapschedules.expectedamount',
         'rapscheduletypes.name AS scheduletype'
       ])
       ->from('rapschedules')
       ->join('INNER JOIN', 'rapscheduletypes', 'rapscheduletypes.id = rapschedules.rapscheduletypeID');

       // Get all schedule amounts
       $scheduleswithraps = (new Query())
       ->select([
        'schedules.id', 
        'schedules.rapID AS schedulerapID',
        'schedules.rapscheduletypeID AS scheduletypeID',
        'schedules.duedate',
        'schedules.expectedamount',
        'schedules.scheduletype',
        'rap.amount AS deficit', 
        'rap.startdate', 
        'rap.enddate'
      ])
      ->from(['schedules' => $schedules])
      ->join('INNER JOIN', 'rap', 'schedules.rapID = rap.id');

       // Get all raps with payments
       $scheduleswithpayments = (new Query())
       ->select([
        'schedules.id AS scheduleID',
        'schedules.schedulerapID',
        'schedules.scheduletypeID',
        'schedules.duedate', 
        'schedules.expectedamount',
        'schedules.scheduletype',
        'rappayments.paymentdate',
        'rappayments.amount AS payments'

        'schedules.id', 
        'schedules.rapID AS schedulerapID',
        'schedules.rapscheduletypeID AS scheduletypeID',
        'schedules.duedate',
        'schedules.expectedamount',
        'schedules.scheduletype',
        'rap.amount AS deficit', 
        'rap.startdate', 
        'rap.enddate'
      ])
      ->from(['schedules' => $schedules])
      ->join('INNER JOIN', 'rappayments', 'schedules.id = rappayments.scheduleID');

    // Merge Everything
    $query = (new Query())
    ->select([
      'scheduleID',
      'schedulerapID',
      'scheduletypeID',
      'duedate',
      'expectedamount',
      'scheduletype',
      'paymentdate',
      'payments',
      new Expression("CASE WHEN ROW_NUMBER() OVER (PARTITION BY schedulerapID ORDER BY paymentdate) = 1 THEN expectedamount WHEN ROW_NUMBER() OVER (PARTITION BY schedulerapID ORDER BY paymentdate) = 2 THEN +expectedamount
                             WHEN scheduletypeID = '1' OR scheduletypeID = '2' THEN +expectedamount ELSE 0 END AS debits"),
      new Expression("CASE WHEN ROW_NUMBER() OVER (PARTITION BY schedulerapID ORDER BY paymentdate) = 1 THEN 'Openning Balance'        
                             ELSE scheduletype END AS description"),
      new Expression("CASE WHEN scheduletypeID = '1' OR scheduletypeID = '2' THEN +payments ELSE 0 END AS credits"),
   ])
   ->from(['scheduleswithpayments' => $scheduleswithpayments])
   ->where(['schedulerapID'=> $id]);

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
     * Creates a new Rap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('createRap'))
        {
            $model = new Rap();
            $model->rapfile = UploadedFile::getInstance($model, 'rapfile');

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    $scheme = Schemes::find()->where(['id'=>$model->schemeID])->one();
                    $model->name = 'RAP' . '-' . $model->id . '-' . $scheme->ref;
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }
    
            return $this->render('create', [
                'model' => $model,
                'schemes' => Schemes::find()->all(),
            ]);
        }else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Rap model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->rapfile = UploadedFile::getInstance($model, 'rapfile');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'schemes' => Schemes::find()->all(),
        ]);
    }

    /**
     * Deletes an existing Rap model.
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

    public function actionPdf($id) {
        $model = Rap::findOne($id);
    
        // This will need to be the path relative to the root of your app.
        $filePath = '/uploads';
        // Might need to change '@app' for another alias
        $completePath = Yii::getAlias('@backend/web/storage'.$model->rapdocument);
    
        return Yii::$app->response->sendFile($completePath, $model->rapdocument);
    }

    /**
     * Finds the Rap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Rap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rap::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

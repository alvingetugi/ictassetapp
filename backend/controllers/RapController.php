<?php

namespace backend\controllers;

use common\models\Rapschedules;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;
use PhpOffice\PhpSpreadsheet\Shared\Date;
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
        // Get all raps
        $raps = (new Query())
            ->select([
                'rap.id AS rapID',
                'rap.name AS ref',
                'rap.amount',
                'rap.startdate AS transdate',
                'rap.comments'
            ])
            ->from('rap');

        // Get all schedules
        $schedules = (new Query())
            ->select([
                'rapschedules.rapID',
                'rapschedules.name AS ref',
                'rapschedules.expectedamount as amount',
                'rapschedules.duedate AS transdate',
                'rapschedules.comments AS comments'
            ])
            ->from('rapschedules');

        // Get all payments
        $payments = (new Query())
            ->select([
                'rappayments.rapID',
                'rappayments.name AS ref',
                'rappayments.amount',
                'rappayments.paymentdate AS transdate',
                'rappayments.comments AS comments'
            ])
            ->from('rappayments');

        $transactions = (new Query())
            ->from(['transactions' => $raps->union($schedules)->union($payments)]);

        $referencedtransactions = (new Query())
            ->select([
                'rapID',
                new Expression("CASE WHEN ref LIKE '%RAP%' THEN 'Openning Balance'        
                                WHEN ref LIKE '%PMT%' THEN 'Payment'
                                ELSE ref
                                END AS ref"),
                'amount',
                'transdate',
                'comments'
            ])
            ->from(['transactions' => $transactions]);

        $closingbalance = (new Query())
            ->select([
                'rapID',
                'ref',
                'amount',
                'transdate',
                'comments',
                new Expression("SUM(CASE WHEN ref = 'Openning Balance' OR ref = 'Penalty' THEN amount 
                                WHEN ref = 'Payment' Then -amount
                                ELSE 0 END) 
                                OVER (ORDER BY transdate, rapID) AS closingbalance")
                            ])
                            ->from(['referencedtransactions' => $referencedtransactions])
                            ->where(['rapID' => $id]);

        $openningbalance = (new Query())
            ->select([
                'rapID',
                'ref',
                'amount',
                'transdate',
                'comments',
                'closingbalance',
                new Expression("LAG(closingbalance) OVER (PARTITION BY rapID ORDER BY transdate) AS openningbalance"),
                new Expression("CASE WHEN ref = 'Openning Balance' or ref = 'Schedule' or ref = 'Penalty' THEN amount 
                             ELSE 0
                            END AS debit"),
                new Expression("CASE WHEN ref = 'Payment' THEN amount 
                             ELSE 0
                            END AS credit")
            ])
            ->from(['closingbalance' => $closingbalance])
            ->where(['rapID' => $id]);

        $query = (new Query())
            ->select([
                'rapID',
                'ref',
                new Expression("FORMAT(amount, 'N', 'en-us') AS amount"),
                new Expression("FORMAT(debit, 'N', 'en-us') AS debit"),
                new Expression("FORMAT(credit, 'N', 'en-us') AS credit"),
                'transdate',
                'comments',
                new Expression("FORMAT(closingbalance, 'N', 'en-us') AS closingbalance"),
                new Expression("FORMAT(openningbalance, 'N', 'en-us') AS openningbalance")
            ])
            ->from(['openningbalance' => $openningbalance])
            ->orderBy(['transdate' => SORT_ASC])
            ->where(['rapID' => $id])
            ->andWhere(['=', 'ref', 'Openning Balance'])
            ->orWhere(['=', 'ref', 'Penalty'])
            ->orWhere(['=', 'ref', 'Payment']);

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

    public function actionImport()
    {
        $id = Yii::$app->request->get('id'); // Get the record ID from the URL

        if (Yii::$app->request->isPost) {
            $model = new Rap(); // Replace with your model
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file) {
                $spreadsheet = IOFactory::load($model->file->tempName);
                // Get the active sheet
                $sheet = $spreadsheet->getActiveSheet();
                $max = $sheet->getHighestRow();
                $start = 2;

                // Process data and save to the database
                for ($row = $start; $row <= $max; $row++) {       
                    
                    $schedulemodel = new Rapschedules();
                    $schedulemodel->rapID = $id;
                    $schedulemodel->name = $sheet->getCell('A' . $row)->getValue();
                    $DateCell = $sheet->getCell('B' . $row);
                    $timestamp = Date::excelToTimestamp($DateCell->getValue());
                    $schedulemodel->duedate  = date('Y-m-d', $timestamp);
                    $schedulemodel->expectedamount = $sheet->getCell('C' . $row)->getValue();
                    $schedulemodel->comments = $sheet->getCell('D' . $row)->getValue();
                    $schedulemodel->save();

                }

                Yii::$app->session->setFlash('success', 'Import successful.');
                return $this->redirect(['view', 'id' => $id]); // Redirect after import
            }
        }

        return $this->render('view', ['id' => $id]); // Render the view with the ID
    }

}

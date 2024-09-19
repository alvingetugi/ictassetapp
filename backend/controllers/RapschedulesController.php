<?php

namespace backend\controllers;

use common\models\Rap;
use common\models\Rapschedules;
use backend\models\search\RapschedulesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\ExcelUploadForm;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Yii;

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
        return $this->render('view', [
            'model' => $this->findModel($id),
            
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
                $model->name = 'SCHDL' . '-' . $model->id . '-' . $rap->id;
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

    public function actionImport()
    {
        $model = new ExcelUploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                // Load the spreadsheet
                $spreadsheet = IOFactory::load($model->file->tempName);

                // Get the active sheet
                $sheet = $spreadsheet->getActiveSheet();
                $data = $sheet->toArray();

                // Process each row
                foreach ($data as $row) {
                    // Skip header row
                    if ($row[0] === 'Header1') {
                        continue;
                    }

                    // Process data and save to the database
                    $model = new Rapschedules();
                    $model->rapID = $row[0];
                    $model->rapscheduletypeID = $row[1];
                    $model->name = $row[2];
                    $model->duedate = $row[3];
                    $model->expectedamount = $row[4];
                    $model->comments = $row[5];
                    $model->save();
                }

                Yii::$app->session->setFlash('success', 'Data imported successfully.');
                return $this->redirect(['import']);
            }
        }

        return $this->render('import', ['model' => $model]);
    }
}

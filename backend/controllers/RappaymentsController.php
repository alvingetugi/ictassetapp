<?php

namespace backend\controllers;

use common\models\Rap;
use common\models\Rapcommitments;
use Yii;
use common\models\Rappayments;
use common\models\Schemes;
use backend\models\search\RappaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RappaymentsController implements the CRUD actions for Rappayments model.
 */
class RappaymentsController extends Controller
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
     * Lists all Rappayments models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RappaymentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rappayments model.
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
     * Creates a new Rappayments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Rappayments();
        $model->paymentfile = UploadedFile::getInstance($model, 'paymentfile');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $rap = Rap::find()->where(['id'=>$model->rapID])->one();
                $cmt = Rapcommitments::find()->where(['id'=>$model->commitmentID])->one();
                $model->name = 'PMT' . '-' . $model->id . '-' . $rap->name . '-' . $cmt->name;
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
     * Updates an existing Rappayments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->paymentfile = UploadedFile::getInstance($model, 'paymentfile');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Rappayments model.
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
     * Finds the Rappayments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Rappayments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rappayments::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPdf($id) {
        $model = Rappayments::findOne($id);
    
        // This will need to be the path relative to the root of your app.
        $filePath = '/payments';
        // Might need to change '@app' for another alias
        $completePath = Yii::getAlias('@backend/web/storage'.$model->proof);
    
        return Yii::$app->response->sendFile($completePath, $model->proof);
    }

    //Handles the dependency action for selecting a make
    public function actionCommitments() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $rap_id = $parents[0];
                $out = Rapcommitments::getCommitmentsList($rap_id, true);
                return json_encode(['output'=>$out, 'selected'=>'']);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }
}

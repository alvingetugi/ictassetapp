<?php

namespace backend\controllers;

use Yii;
use common\models\Rap;
use common\models\Rapcommitments;
use backend\models\search\RapcommitmentsSearch;
use common\models\Schemes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RapcommitmentsController implements the CRUD actions for Rapcommitments model.
 */
class RapcommitmentsController extends Controller
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
     * Lists all Rapcommitments models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RapcommitmentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rapcommitments model.
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
     * Creates a new Rapcommitments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Rapcommitments();
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        $raps = Schemes::findBySql("
                    SELECT 
                        s.id as scheme_id, 
                        s.ref as scheme_ref, 
                        s.name as scheme_name, 
                        r.id as id, 
                        r.amount as rap_amount, 
                        r.status as rap_status 
                    FROM schemes s 
                    LEFT JOIN rap r on s.id = r.schemeID 
                    WHERE r.status=1")
                    ->asArray()
                    ->all();
            
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'raps' => $raps,
            
        ]);
    }

    /**
     * Updates an existing Rapcommitments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        $raps = Schemes::findBySql("
                    SELECT 
                        s.id as scheme_id, 
                        s.ref as scheme_ref, 
                        s.name as scheme_name, 
                        r.id as id, 
                        r.amount as rap_amount, 
                        r.status as rap_status 
                    FROM schemes s 
                    LEFT JOIN rap r on s.id = r.schemeID 
                    WHERE r.status=1")
                    ->asArray()
                    ->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'raps' => $raps,
        ]);
    }

    /**
     * Deletes an existing Rapcommitments model.
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
     * Finds the Rapcommitments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Rapcommitments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rapcommitments::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

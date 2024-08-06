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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
                    $model->name = 'RAP' . '-' . $model->id . '-' . $scheme->name;
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

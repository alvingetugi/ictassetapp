<?php

namespace backend\controllers;

use common\models\Ictassets;
use common\models\Surrenders;
use backend\models\search\SurrendersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * SurrendersController implements the CRUD actions for Surrenders model.
 */
class SurrendersController extends Controller
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
     * Lists all Surrenders models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SurrendersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Surrenders model.
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
     * Creates a new Surrenders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Surrenders();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->accessorylistID = implode(',', $model->accessorylistID);        
                $model->save();
               
                $asset = Ictassets::find()->where(['id'=>$model->serialnumber])->one();//finds the asset being issued based on serial number
                $asset->assetstatus = 3;//sets the asset status to Surrendered
                $asset->save();

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
     * Updates an existing Surrenders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->accessorylistID = implode(',', $model->accessorylistID);        
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->accessorylistID= explode(',', $model->accessorylistID);
            return $this->render('update', [
            'model' => $model,
        ]);
        }
    }

    /**
     * Deletes an existing Surrenders model.
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
     * Finds the Surrenders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Surrenders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Surrenders::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Surrenders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreatewithmodal()
    {
        $model = new Surrenders();
        $surrenderserialnumberID = Yii::$app->request->get('surrenderserialnumberID'); // Get the serial number from query params

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->accessorylistID = implode(',', $model->accessorylistID);        
                $model->save();
               
                $asset = Ictassets::find()->where(['id'=>$model->serialnumber])->one();//finds the asset being issued based on serial number
                $asset->assetstatus = 3;//sets the asset status to Surrendered
                $asset->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->renderAjax('_form_fields', [
            'model' => $model,
            'surrenderserialnumberID' => $surrenderserialnumberID,
        ]);
    }
}

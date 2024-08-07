<?php

namespace backend\controllers;

use common\models\Rap;
use common\models\Schemes;
use backend\models\search\SchemesSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
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
            $schemeraps = (new Query())
                ->select(['r.id AS rap_id', 'r.schemeID AS scheme_id', 'r.typeID AS typeID', 'r.status AS status', 'r.amount As amount', 'r.startdate as startdate', 'sum(c.expectedamount) AS expectedamount'])
                ->from(['rap r'])
                ->join('LEFT JOIN', 'rapcommitments c', 'r.id = c.rapID')
                ->where(['r.schemeID'=> $id])
                ->groupBy('r.id, r.schemeID, r.typeID, r.status, r.amount, r.startdate')
                ->all();

            $dataProvider = new ActiveDataProvider([

                'query' => (new Query())
                ->select(['r.id as rapID', 'r.name AS rapref', 'r.amount As deficit', 'r.startdate as startdate', 't.name AS type', 'sum(c.expectedamount) AS totalcommitments', 'sum(p.amount) AS totalpaid'])
                ->from(['rap r'])
                ->join('FULL JOIN', 'raptypes t', 't.id = r.typeID')
                ->join('FULL JOIN', 'rapcommitments c', 'r.id = c.rapID')
                ->join('FULL JOIN', 'rappayments p', 'c.id = p.commitmentID')
                ->where(['r.schemeID'=> $id])
                ->groupBy('r.id, r.name, t.name, r.amount, r.startdate')
            
                ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'schemeraps' => $schemeraps,
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

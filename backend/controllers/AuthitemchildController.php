<?php

namespace backend\controllers;

use common\models\Authitemchild;
use backend\models\search\AuthitemchildSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthitemchildController implements the CRUD actions for Authitemchild model.
 */
class AuthitemchildController extends Controller
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
     * Lists all Authitemchild models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AuthitemchildSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Authitemchild model.
     * @param string $child Child
     * @param string $parent Parent
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($child, $parent)
    {
        return $this->render('view', [
            'model' => $this->findModel($child, $parent),
        ]);
    }

    /**
     * Creates a new Authitemchild model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Authitemchild();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'child' => $model->child, 'parent' => $model->parent]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Authitemchild model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $child Child
     * @param string $parent Parent
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($child, $parent)
    {
        $model = $this->findModel($child, $parent);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'child' => $model->child, 'parent' => $model->parent]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Authitemchild model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $child Child
     * @param string $parent Parent
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($child, $parent)
    {
        $this->findModel($child, $parent)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Authitemchild model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $child Child
     * @param string $parent Parent
     * @return Authitemchild the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($child, $parent)
    {
        if (($model = Authitemchild::findOne(['child' => $child, 'parent' => $parent])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

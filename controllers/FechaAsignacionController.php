<?php

namespace app\controllers;

use app\models\AsigTlmkCliente;
use Yii;
use app\models\FechaAsignacion;
use app\models\FechaAsignacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use synatree\dynamicrelations\DynamicRelations;

/**
 * FechaAsignacionController implements the CRUD actions for FechaAsignacion model.
 */
class FechaAsignacionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FechaAsignacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FechaAsignacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FechaAsignacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FechaAsignacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FechaAsignacion();

        if ($model->load(Yii::$app->request->post())) {
            $codigo = $model->codigo_asig = $model->getCodigo();
            $model->Fecha_Creada = substr($model->Fecha_Creada, 6, 4) . '/' . substr($model->Fecha_Creada, 3, 2) . '/' . substr($model->Fecha_Creada, 0, 2); //'2016-06-09' ;
            $model->save();
            DynamicRelations::relate($model, 'asigTlmkClientes', Yii::$app->request->post(), 'AsigTlmkCliente', AsigTlmkCliente::className());
            $model->SP_Estado($codigo);
            Yii::$app->session->setFlash('success', 'Se asignó correctamente el cliente.');
            return $this->redirect(['create']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FechaAsignacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codigo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FechaAsignacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FechaAsignacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FechaAsignacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FechaAsignacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

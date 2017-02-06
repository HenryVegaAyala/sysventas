<?php

namespace app\controllers;

use Yii;
use app\models\Anfitrion;
use app\models\AnfitrionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnfitrionController implements the CRUD actions for Anfitrion model.
 */
class AnfitrionController extends Controller
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
     * Lists all Anfitrion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnfitrionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Anfitrion model.
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
     * Creates a new Anfitrion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Anfitrion();

        if ($model->load(Yii::$app->request->post())) {

            $model->Codigo = $model->getCodigoAnfitrion();
            $model->Fecha_Creado = $this->ZonaHoraria();
            $model->Usuario_Creado = Yii::$app->user->identity->email;
            $model->Estado = '1';

            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Anfitrion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->Fecha_Modificado = $this->ZonaHoraria();
            $model->Usuario_Modificado = Yii::$app->user->identity->email;
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Anfitrion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = new Anfitrion();

        $fh_delete = $model->Fecha_Eliminado = $this->ZonaHoraria();
        $usuario = $model->Usuario_Eliminado = Yii::$app->user->identity->email;
        $estado = $model->Estado = '0';
        $model->ActualizarUsuario($id, $fh_delete, $usuario, $estado);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Anfitrion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Anfitrion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Anfitrion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function ZonaHoraria()
    {
        date_default_timezone_set('America/Lima');
        $Fecha_Hora = date('Y-m-d h:i:s', time());
        return $Fecha_Hora;
    }

    public function actionAnfitrion()
    {
        $model = new Anfitrion();

        if ($model->load(Yii::$app->request->post())) {

            $turno = $model->Turno;
            $descanso = $model->Descanso;

            $fechaIni = substr($model->Fecha_Creado, 6, 4) . '/' . substr($model->Fecha_Creado, 3, 2) . '/' . substr($model->Fecha_Creado, 0, 2); //'2016-06-09' ;
            $fechaFin = substr($model->Fecha_Modificado, 6, 4) . '/' . substr($model->Fecha_Modificado, 3, 2) . '/' . substr($model->Fecha_Modificado, 0, 2); //'2016-06-09' ;

            return $this->render('reporte', ['fechaIni' => $fechaIni, 'fechaFin' => $fechaFin, 'turno' => $turno, 'descanso' => $descanso]);
        } else {
            return $this->render('anfitrion', [
                'model' => $model,
            ]);
        }
    }
}

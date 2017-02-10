<?php

namespace app\controllers;

use Yii;
use app\models\Factura;
use app\models\FacturaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use synatree\dynamicrelations\DynamicRelations;
use app\models\DFactura;

class FacturaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new FacturaSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', ['model' => $model]);
        }
    }

    public function actionCreate()
    {
        $model = new Factura;

        if ($model->load(Yii::$app->request->post())) {

            $Codigo = $model->id = $model->getCodigoFactura();
            $Cliente = $model->Codigo_Cliente = $this->ValidarCliente($model->Codigo_Cliente);
            $Fecha_Crea = $model->Fecha_Creado = $this->ZonaHoraria();
            $Estado = $model->Estado = '1'; //Activo
            $Usu_Crea = $model->Usuario_Creado = Yii::$app->user->identity->email;
            $Pasaporte = $model->Codigo_Combo;
            $model->SP_Factura_AI();
            $model->save();
            DynamicRelations::relate($model, 'dFacturas', Yii::$app->request->post(), 'Dfactura', DFactura::className());
            $model->SP_Factura($Codigo);

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $Codigo = $model->id;

            $model->SP_Delete($Codigo);
            DynamicRelations::relate($model, 'dFacturas', Yii::$app->request->post(), 'Dfactura', DFactura::className());
            $model->SP_Factura($Codigo);

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionFactura($id)
    {
        return $this->render('factura', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Factura::findOne($id)) !== null) {
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

    public function ValidarCliente($nombre)
    {
        $model = new Factura();
        $Codigo = $model->Cliente($nombre);
        return $Codigo;
    }

}

<?php

namespace app\controllers;

use app\models\Cliente;
use app\models\Pasaporte;
use Yii;
use app\models\Venta;
use app\models\VentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\db\Query;

class VentaController extends Controller
{

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

    public function actionIndex()
    {
        $searchModel = new VentaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Venta();

        if ($model->load(Yii::$app->request->post())) {
            $dato = $model->Codigo_Cliente;
            $model->InsertVenta(
                $model->Codigo_venta = $model->getCodigo(),
                $model->Estado = 1,
                $model->Codigo_Cliente = $model->CodigoCliente($dato),
                $model->medio_pago,
                $model->Estado_pago,
                $model->porcentaje_pagado,
                $model->Codigo_club,
                $model->Codigo_pasaporte
            );
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCliente()
    {
        $model = new Venta();

        if ($model->load(Yii::$app->request->post())) {

            return $this->redirect(['cliente/update', 'id' => $model->Codigo_Cliente]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Codigo_venta]);
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

    public function actionContrato($id)
    {
        $model = $this->findModel($id);
        $Cliente = new Cliente();

        $Nombre = $Cliente->Cliente($model->Codigo_Cliente);
        $DNI = $Cliente->DataCliente($model->Codigo_Cliente,1);
        $Direccion = $Cliente->DataCliente($model->Codigo_Cliente,2);
        $Beneficiario = $Cliente->Beneficiario($model->Codigo_Cliente);

        return $this->render('contrato', [
            'model' => $model,
            'Nombre' => $Nombre,
            'DNI' => $DNI,
            'Direccion' => $Direccion,
            'Beneficiario' => $Beneficiario,
        ]);
    }

    public function actionFactura($id)
    {
        $model = $this->findModel($id);
        $Cliente = new Cliente();
        
        $Nombre = $Cliente->Cliente($model->Codigo_Cliente);
        $DNI = $Cliente->DataCliente($model->Codigo_Cliente,1);
        $Direccion = $Cliente->DataCliente($model->Codigo_Cliente,2);
        $Beneficiario = $Cliente->Beneficiario($model->Codigo_Cliente);

        return $this->render('factura', [
            'model' => $model,
            'Nombre' => $Nombre,
            'DNI' => $DNI,
            'Direccion' => $Direccion,
            'Beneficiario' => $Beneficiario,
        ]);
    }

    public function actionArchivo($id)
    {
        die("facutra");
        exit();
    }

    protected function findModel($id)
    {
        if (($model = Venta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

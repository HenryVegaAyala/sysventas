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
//        echo "<script src=".Yii::$app->getUrlManager()->getBaseUrl()."/js/angular.min.js"."></script>";
//        echo "<script src=".Yii::$app->getUrlManager()->getBaseUrl()."/js/app.js"."></script>";
        echo "<script src=\"/dolibar/js/JsBarcode.all.min.js\"></script>";

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
        $DNI = $Cliente->DataCliente($model->Codigo_Cliente, 1);
        $Direccion = $Cliente->DataCliente($model->Codigo_Cliente, 2);
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
        $DNI = $Cliente->DataCliente($model->Codigo_Cliente, 1);
        $Direccion = $Cliente->DataCliente($model->Codigo_Cliente, 2);
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

    public function actionPreproceso()
    {
        $model = new Venta();

        if (Empty($_POST['valorCaja1'])) {
            echo "Debe seleccionar Club";
            exit();
        } elseif (Empty($_POST['valorCaja2'])) {
            echo "Debe seleccionar Pasaporte";
            exit();
        } elseif (Empty($_POST['valorCaja3'])) {
            echo "Debe seleccionar Cliente";
            exit();
        } else {
            $Club = $_POST['valorCaja1'];
            $Pasaporte = $_POST['valorCaja2'];
            $Cliente = $_POST['valorCaja3'];
        }

        $CodCliente = $model->CodigoCliente($Cliente);
        $model->SP_Certificado($Club, $Pasaporte, $CodCliente);
        echo "Se genero Correctamente el codigo de barras";

    }

    public function actionListado()
    {
        $model = new Venta();

//        if (Empty($_POST['Club'])) {
//            echo "Debe seleccionar Club";
//            exit();
//        } elseif (Empty($_POST['Pasaporte'])) {
//            echo "Debe seleccionar Pasaporte";
//            exit();
//        } elseif (Empty($_POST['Cliente'])) {
//            echo "Debe seleccionar Cliente";
//            exit();
//        } else {
        $Club = $_POST['Club'];
        $Pasaporte = $_POST['Pasaporte'];
        $Cliente = $_POST['Cliente'];
        $CodCliente = $model->CodigoCliente($Cliente);
//        echo "$Club" . "$Pasaporte" . "$CodCliente";
//        }
//        $CodCliente = $model->CodigoCliente($Cliente);

//        $connection = Yii::$app->db;
//        $sqlStatement = "
//        SELECT Codigo_Correlativo
//        FROM certificado
//        WHERE Codigo_Cliente = '" . $CodCliente . "' and club_Codigo_club = '" . $Club . "' and pasaporte_Codigo_pasaporte = '" . $Pasaporte . "';
//        ";
//        $comando = $connection->createCommand($sqlStatement);
//        $resultado = $comando->query();
//
//        while ($row = $resultado->read()) {
////            echo '<tr>';
//            echo '<td>' . $resultado['Codigo_Correlativo'] . '</td>';
////            echo '</tr>';
//        }

        $con = mysqli_connect('localhost', 'root', '');
//        $con2 = mysqli_connect('localhost', 'groupg12_rustica', 'root2017');
        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }

        mysqli_select_db($con, "sis_crm");
//        mysqli_select_db($con, "groupg12_rustica");
        $sql = "
        SELECT Codigo_Correlativo
        FROM certificado
        WHERE Codigo_Cliente = '" . $CodCliente . "' and club_Codigo_club = '" . $Club . "' and pasaporte_Codigo_pasaporte = '" . $Pasaporte . "';
        ";
        $result = mysqli_query($con, $sql);

        $cantidad = mysqli_num_rows(($result));

        for ($i = 0; $i < $cantidad;) {

            while ($row = mysqli_fetch_array($result)) {
                echo "<svg id='barcode$i'></svg>";
                echo "<script> JsBarcode('#barcode$i', " . $row['Codigo_Correlativo'] . ");</script>";

                $i++;
            }
        }

        mysqli_close($con);

    }


    protected
    function findModel($id)
    {
        if (($model = Venta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

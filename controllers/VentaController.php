<?php

namespace app\controllers;

use app\models\Certificado;
use app\models\Combo;
use app\models\Comision;
use app\models\FormasPago;
use app\models\Pago;
use Yii;
use app\models\Venta;
use app\models\Cliente;
use app\models\Beneficiario;
use app\models\VentaSearch;
use yii\db\Expression;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use synatree\dynamicrelations\DynamicRelations;

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
        $cliente = new Cliente();
        $certificado = new Certificado();
        $incentivos = new Combo();
        $pago = new Pago();
        $formaPago = new FormasPago();

        if ($model->load(Yii::$app->request->post()) && $cliente->load(Yii::$app->request->post()) && $certificado->load(Yii::$app->request->post()) && $incentivos->load(Yii::$app->request->post()) && $pago->load(Yii::$app->request->post()) && $formaPago->load(Yii::$app->request->post())) {

            $CodigoCliente = $cliente->Codigo_Cliente;
            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('cliente',
                    ['Nombre' => $cliente->Nombre,
                        'Apellido' => $cliente->Apellido,
                        'dni' => $cliente->dni,
                        'Edad' => $cliente->Edad,
                        'Direccion' => $cliente->Direccion,
                        'Distrito' => $cliente->Distrito,
                        'Traslado' => $cliente->Traslado,
                        'Tarjeta_De_Credito' => $cliente->Tarjeta_De_Credito,
                        'Estado_Civil' => $cliente->Estado_Civil,
                        'Profesion' => $cliente->Profesion,
                        'Telefono_Casa' => $cliente->Telefono_Casa,
                        'Telefono_Casa2' => $cliente->Telefono_Casa2,
                        'Telefono_Celular' => $cliente->Telefono_Celular,
                        'Telefono_Celular2' => $cliente->Telefono_Celular2,
                        'Telefono_Celular3' => $cliente->Telefono_Celular3,
                        'Email' => $cliente->Email,
                        'Fecha_Modificado' => $this->ZonaHoraria(),
                        'Usuario_Modificado' => Yii::$app->user->identity->email,
                    ],
                    'Codigo_Cliente = ' . $CodigoCliente)
                ->execute();

            $model->Codigo_venta = $model->getCodigoVenta();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO venta (Codigo_venta,Codigo_club, Codigo_pasaporte, Codigo_Cliente, numero_contrato, numero_pasaporte, Fecha_Creado,Usuario_Creado, Estado,numero_comprobante,serie_comprobante,salas)
                VALUES (:Codigo_venta,:Codigo_club,:Codigo_pasaporte,:Codigo_Cliente,:numero_contrato,:numero_pasaporte,:Fecha_Creado,:Usuario_Creado,:Estado,:numero_comprobante,:serie_comprobante,:salas)");
            $command->bindValue(':Codigo_venta', $model->Codigo_venta);
            $command->bindValue(':Codigo_club', $model->Codigo_club);
            $command->bindValue(':Codigo_pasaporte', $model->Codigo_pasaporte);
            $command->bindValue(':Codigo_Cliente', $cliente->Codigo_Cliente);
            $command->bindValue(':numero_contrato', $model->numero_contrato);
            $command->bindValue(':numero_pasaporte', $model->numero_pasaporte);
            $command->bindValue(':Fecha_Creado', $this->ZonaHoraria());
            $command->bindValue(':Usuario_Creado', Yii::$app->user->identity->email);
            $command->bindValue(':Estado', 1);
            $command->bindValue(':numero_comprobante', $model->numero_comprobante);
            $command->bindValue(':serie_comprobante', $model->serie_comprobante);
            $command->bindValue(':salas', $model->salas);
            $command->execute();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO combo (Codigo_venta,convetidor1,convetidor2,Regalos,Observacion,Fecha_Creado,Usuario_Creado,Estado)
                VALUES (:Codigo_venta,:convetidor1,:convetidor2,:Regalos,:Observacion,:Fecha_Creado,:Usuario_Creado,:Estado)");
            $command->bindValue(':Codigo_venta', $model->Codigo_venta);
            $command->bindValue(':convetidor1', $incentivos->convetidor1);
            $command->bindValue(':convetidor2', $incentivos->convetidor2);
            $command->bindValue(':Regalos', $incentivos->Regalos);
            $command->bindValue(':Observacion', $incentivos->Observacion);
            $command->bindValue(':Fecha_Creado', $this->ZonaHoraria());
            $command->bindValue(':Usuario_Creado', Yii::$app->user->identity->email);
            $command->bindValue(':Estado', "1");
            $command->execute();

            $pago->codigo_pago = $model->getCodigoPago();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO pago (Codigo_venta,codigo_pago,tipo_pago,estado_pago,monto_pagado,monto_ingresado,monto_restante,Fecha_Creado,Usuario_Creado,Estado)
                VALUES (:Codigo_venta,:codigo_pago,:tipo_pago,:estado_pago,:monto_pagado,:monto_ingresado,:monto_restante,:Fecha_Creado,:Usuario_Creado,:Estado)");
            $command->bindValue(':Codigo_venta', $model->Codigo_venta);
            $command->bindValue(':codigo_pago', $pago->codigo_pago);
            $command->bindValue(':tipo_pago', $pago->tipo_pago);
            $command->bindValue(':estado_pago', $pago->estado_pago);
            $command->bindValue(':monto_pagado', $model->montoTotal);
            $command->bindValue(':monto_ingresado', $pago->monto_ingresado);
            $command->bindValue(':monto_restante', $pago->monto_restante);
            $command->bindValue(':Fecha_Creado', $this->ZonaHoraria());
            $command->bindValue(':Usuario_Creado', Yii::$app->user->identity->email);
            $command->bindValue(':Estado', "1");
            $command->execute();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO formas_pago (Codigo_TipoPago,codigo_pago,fecha_pago,monto,Fecha_Creado,Usuario_Creado,Estado)
                VALUES (:Codigo_TipoPago,:codigo_pago,:fecha_pago,:monto,:Fecha_Creado,:Usuario_Creado,:Estado)");
            $command->bindValue(':Codigo_TipoPago', $model->getCodigoFormaPago());
            $command->bindValue(':codigo_pago', $pago->codigo_pago);
            $command->bindValue(':fecha_pago', $formaPago->fecha_pago);
            $command->bindValue(':monto', $formaPago->monto);
            $command->bindValue(':Fecha_Creado', $this->ZonaHoraria());
            $command->bindValue(':Usuario_Creado', Yii::$app->user->identity->email);
            $command->bindValue(':Estado', "1");
            $command->execute();

            Yii::$app->db->createCommand()
                ->batchInsert('comision', ['Codigo', 'Codigo_venta', 'Codigo_usuario', 'Fecha_Creado', 'Usuario_Creado', 'Estado'],
                    [
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision1, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision2, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision3, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision4, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision5, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision6, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision7, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision8, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision9, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision10, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision11, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision12, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                        [$model->getCodigoComision(), $model->Codigo_venta, $model->codigo_comision13, $this->ZonaHoraria(), Yii::$app->user->identity->email, 1],
                    ])
                ->execute();

            DynamicRelations::relate($cliente, 'beneficiarios', Yii::$app->request->post(), 'Beneficiario', Beneficiario::className());

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('certificado',
                    [
                        'Codigo_Venta' => $model->Codigo_venta,
                        'Estado' => 3,
                        'Fecha_Modificado' => $this->ZonaHoraria(),
                        'Usuario_Modificado' => Yii::$app->user->identity->email,
                    ],
                    'Codigo_pasaporte = "' . $model->numero_pasaporte . '"')
                ->execute();

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('detalle_pasaporte',
                    [
                        'Fecha_Modificado' => $this->ZonaHoraria(),
                        'Usuario_Modificado' => Yii::$app->user->identity->email,
                        'Estado' => 3,
                    ],
                    'Codigo_pasaporte = "' . $model->numero_pasaporte . '"')
                ->execute();

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cliente' => $cliente,
                'certificado' => $certificado,
                'incentivos' => $incentivos,
                'pago' => $pago,
                'formaPago' => $formaPago,

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

    public function actionBusqueda()
    {
        $model = new Venta();

        $Cliente = $_POST['cliente'];
        $CodCliente = $model->CodigoCliente($Cliente);
        $estado = "11";
        $connection = Yii::$app->db;
        $sqlStatement = " SELECT * FROM cliente WHERE Codigo_Cliente = '" . $CodCliente . "'";
        $comando = $connection->createCommand($sqlStatement);
        $resultado = $comando->query();

        while ($row = $resultado->read()) {
            echo $row['Codigo_Cliente'];
            echo "/";
            echo $row['Nombre'];
            echo "/";
            echo $row['Apellido'];
            echo "/";
            echo $row['Profesion'];
            echo "/";
            echo $row['Edad'];
            echo "/";
            echo $row['Estado_Civil'];
            echo "/";
            echo $row['Distrito'];
            echo "/";
            echo $row['Direccion'];
            echo "/";
            echo $row['Telefono_Casa'];
            echo "/";
            echo $row['Telefono_Casa2'];
            echo "/";
            echo $row['Telefono_Celular'];
            echo "/";
            echo $row['Telefono_Celular2'];
            echo "/";
            echo $row['Telefono_Celular3'];
            echo "/";
            echo $row['Email'];
            echo "/";
            echo $row['Traslado'];
            echo "/";
            echo $row['Tarjeta_De_Credito'];
            echo "/";
            echo $row['Promotor'];
            echo "/";
            echo $row['Local'];
            echo "/";
            echo $row['dni'];
            echo "/";
            echo $row['Super_Promotor'];
            echo "/";
            echo $row['Jefe_Promotor'];
            echo "/";
        }
    }

    public function actionValidarpasaporte()
    {

        if (Empty($_POST['tipopasaporte'])) {
            echo "<i class=\"fa fa-spinner fa-spin fa-2x fa-fw\"></i> Debe seleccionar un Pasaporte.";
            exit();
        } elseif (Empty($_POST['codigobarra'])) {
            echo "<i class=\"fa fa-spinner fa-spin fa-2x fa-fw\"></i> Debe ingresar el codigo de barra.";
            exit();
        } else {
            $TipoPasaporte = $_POST['tipopasaporte'];
            $CodigoBarra = $_POST['codigobarra'];
        }

        $query = new Query();
        $select = new Expression("Estado");
        $where = new Expression("Codigo_pasaporte = $TipoPasaporte and codigo_barra = '" . $CodigoBarra . "'");
        $query->select($select)->from('detalle_pasaporte')->where($where)->limit(1);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();

        if ($data == 1) {
            echo "<i class=\"fa fa-font-awesome fa-2x  text-success\" aria-hidden=\"true\"></i> Este codigo puede usarse. ";
        } elseif ($data == 2) {
            echo "<i class=\"fa fa-font-awesome fa-2x  text-yellow\" aria-hidden=\"true\"></i> Este codigo ha sido solicitado. ";
        } elseif ($data == 3) {
            echo "<i class=\"fa fa-font-awesome fa-2x  text-danger\" aria-hidden=\"true\"></i> Este codigo ha sido usado. ";
        } elseif ($data == null) {
            echo "<i class=\"fa fa-wrench fa-2x  text-danger\" aria-hidden=\"true\"></i></i> No existe ese codigo. ";
        }
    }

    public function actionInsertcodigobarra()
    {

        if (Empty($_POST['codigobarra'])) {
            echo "<i class=\"fa fa-spinner fa-spin fa-2x fa-fw\"></i> Debe Ingresar Codigo Certificado.";
            exit();
        } elseif (Empty($_POST['totalnoches'])) {
            echo "<i class=\"fa fa-spinner fa-spin fa-2x fa-fw\"></i> Debe Seleccionar tipo Club.";
            exit();
        } elseif (Empty($_POST['codigopasaporte'])) {
            echo "<i class=\"fa fa-spinner fa-spin fa-2x fa-fw\"></i> Debes tener un pasaporte activo.";
            exit();
        } else {
            $CodigoBarra = $_POST['codigobarra'];
            $TotalNoches = $_POST['totalnoches'];
            $codigopasaporte = $_POST['codigopasaporte'];
        }

        $query = new Query();
        $select = new Expression("Estado");
        $where = new Expression("codigo_barra = '" . $CodigoBarra . "'");
        $query->select($select)->from('certificado')->where($where)->limit(1);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();

        if ($data == 1) {
            echo "<i class=\"fa fa-font-awesome fa-2x  text-success\" aria-hidden=\"true\"></i> Este codigo puede usarse. ";
            $connection = Yii::$app->db;
            $command = $connection->createCommand("call ProcesarCertificado('" . $CodigoBarra . "','" . $codigopasaporte . "')");
            $command->execute();
        } elseif ($data == 2) {
            echo "<i class=\"fa fa-font-awesome fa-2x  text-yellow\" aria-hidden=\"true\"></i> Este codigo ha sido solicitado. ";
        } elseif ($data == 3) {
            echo "<i class=\"fa fa-font-awesome fa-2x  text-danger\" aria-hidden=\"true\"></i> Este codigo ha sido usado. ";
        } elseif ($data == null) {
            echo "<i class=\"fa fa-wrench fa-2x  text-danger\" aria-hidden=\"true\"></i></i> No existe ese codigo. ";
        }
    }

    public function actionCargardata()
    {
        if (Empty($_POST['codigopasaporte'])) {
            exit();
        } else {
            $codigopasaporte = $_POST['codigopasaporte'];
        }

        $transaction = Yii::$app->db;
        $transaction->createCommand()
            ->update('detalle_pasaporte',
                ['Estado' => 2],
                'codigo_barra = "' . $codigopasaporte . '"')
            ->execute();

        $connection = Yii::$app->db;
        $sqlStatement = "SELECT codigo_barra FROM certificado WHERE Codigo_pasaporte = '" . $codigopasaporte . "'";
        $comando = $connection->createCommand($sqlStatement);
        $resultado = $comando->query();

//        $count = $resultado->rowCount;

        while ($row = $resultado->read()) {
            echo $row['codigo_barra'];
            echo " - ";
        }

//        echo $count;
    }

    public function actionCount()
    {
        if (Empty($_POST['codigopasaporte'])) {
            exit();
        } else {
            $codigopasaporte = $_POST['codigopasaporte'];
        }

        $connection = Yii::$app->db;
        $sqlStatement = "SELECT codigo_barra FROM certificado WHERE Codigo_pasaporte = '" . $codigopasaporte . "'";
        $comando = $connection->createCommand($sqlStatement);
        $resultado = $comando->query();

        $count = $resultado->rowCount;
        echo $count;
    }

    public function actionCosto()
    {
        if (Empty($_POST['codigo'])) {
            exit();
        } else {
            $codigo = $_POST['codigo'];
        }
        $query = new Query();
        $select = new Expression("precio");
        $where = new Expression("Codigo_club = '" . $codigo . "'");
        $query->select($select)->from('club')->where($where)->limit(1);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();

        echo $data;
    }

    protected function findModel($id)
    {
        if (($model = Venta::findOne($id)) !== null) {
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

    public function actionVenta()
    {
        $model = new Venta();

        if ($model->load(Yii::$app->request->post())) {

            $fechaIni = substr($model->Fecha_Creado, 6, 4) . '/' . substr($model->Fecha_Creado, 3, 2) . '/' . substr($model->Fecha_Creado, 0, 2); //'2016-06-09' ;
            $fechaFin = substr($model->Fecha_Eliminado, 6, 4) . '/' . substr($model->Fecha_Eliminado, 3, 2) . '/' . substr($model->Fecha_Eliminado, 0, 2); //'2016-06-09' ;
            $codigoClub = $model->Codigo_club;
            $codigoPasaporte = $model->Codigo_pasaporte;
            $codigoCliente = $model->Codigo_Cliente;
            $CodigoVenta = $model->Codigo_venta;

            return $this->render('reporteventa', [
                'fechaIni' => $fechaIni,
                'fechaFin' => $fechaFin,
                'codigoClub' => $codigoClub,
                'codigoPasaporte' => $codigoPasaporte,
                'codigoCliente' => $codigoCliente,
                'CodigoVenta' => $CodigoVenta
            ]);
            
        } else {
            return $this->render('venta', [
                'model' => $model,
            ]);
        }
    }


}

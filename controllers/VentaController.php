<?php

namespace app\controllers;

use app\models\Certificado;
use app\models\Combo;
use app\models\Comision;
use app\models\Cotitular;
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

    public function actionLista()
    {
        $searchModel = new VentaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('lista', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCobranza()
    {
        $searchModel = new VentaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('cobranza', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $CodigoCombo = new Combo();
        $idcombo = $CodigoCombo->getCodigoCombo($id);

        $CodigoComisiones = new Comision();
        $idcomision = $CodigoComisiones->getCodigoComision($id);

        $model = $this->findModel($id);
        $cliente = $this->findModelCliente($model->Codigo_Cliente);
        $incentivos = $this->findModelCombo($idcombo);

        $CodigoPago = new Pago();
        $idPago = $CodigoPago->CodigoPago($id);

        $pago = $this->findModelPago($idPago);
        $comision = $this->findModelComision($idcomision);

        return $this->render('view', [
            'model' => $model,
            'cliente' => $cliente,
            'incentivos' => $incentivos,
            'pago' => $pago,
            'comision' => $comision
        ]);
    }

    public function actionVista($id)
    {
        $CodigoCombo = new Combo();
        $idcombo = $CodigoCombo->getCodigoCombo($id);

        $CodigoComisiones = new Comision();
        $idcomision = $CodigoComisiones->getCodigoComision($id);

        $model = $this->findModel($id);
        $cliente = $this->findModelCliente($model->Codigo_Cliente);
        $incentivos = $this->findModelCombo($idcombo);

        $CodigoPago = new Pago();
        $idPago = $CodigoPago->CodigoPago($id);

        $pago = $this->findModelPago($idPago);
        $comision = $this->findModelComision($idcomision);

        return $this->render('vista', [
            'model' => $model,
            'cliente' => $cliente,
            'incentivos' => $incentivos,
            'pago' => $pago,
            'comision' => $comision
        ]);
    }

    public function actionCreate()
    {
        $model = new Venta();
        $cliente = new Cliente();
        $certificado = new Certificado();
        $incentivos = new Combo();
        $pago = new Pago();
        $comision = new Comision();
        $cotitular = new Cotitular();

        if ($cotitular->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()) && $cliente->load(Yii::$app->request->post()) && $certificado->load(Yii::$app->request->post()) && $incentivos->load(Yii::$app->request->post()) && $pago->load(Yii::$app->request->post()) && $comision->load(Yii::$app->request->post())) {

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

            $command = Yii::$app->db->createCommand(
                "INSERT INTO cotitular (Codigo_Cotitular,Codigo_Cliente,Nombre,Apellido,dni,Edad,Direccion,Distrito,Traslado,Tarjeta_De_Credito,Estado_Civil,
Profesion,Telefono_Casa,Telefono_Casa2,Telefono_Celular,Telefono_Celular2,Telefono_Celular3,Email,Usuario_Creado,Fecha_Creado,Estado)
                VALUES (:Codigo_Cotitular, :Codigo_Cliente, :Nombre, :Apellido, :dni, :Edad, :Direccion, :Distrito, :Traslado, :Tarjeta_De_Credito, :Estado_Civil,
:Profesion, :Telefono_Casa, :Telefono_Casa2, :Telefono_Celular, :Telefono_Celular2, :Telefono_Celular3, :Email, :Usuario_Creado, :Fecha_Creado, :Estado)");
            $command->bindValue(':Codigo_Cotitular', $cotitular->getCodigo());
            $command->bindValue(':Codigo_Cliente', $cliente->Codigo_Cliente);
            $command->bindValue(':Nombre', $cotitular->Nombre);
            $command->bindValue(':Apellido', $cotitular->Apellido);
            $command->bindValue(':dni', $cotitular->dni);
            if ($cotitular->Edad == '') {
                $command->bindValue(':Edad', 0);
            } else {
                $command->bindValue(':Edad', $cotitular->Edad);
            }
            $command->bindValue(':Direccion', $cotitular->Direccion);
            $command->bindValue(':Distrito', $cotitular->Distrito);
            $command->bindValue(':Traslado', $cotitular->Traslado);
            if ($cotitular->Tarjeta_De_Credito == '') {
                $command->bindValue(':Tarjeta_De_Credito', 0);
            } else {
                $command->bindValue(':Tarjeta_De_Credito', $cotitular->Tarjeta_De_Credito);
            }
            $command->bindValue(':Estado_Civil', $cotitular->Estado_Civil);
            $command->bindValue(':Profesion', $cotitular->Profesion);
            $command->bindValue(':Telefono_Casa', $cotitular->Telefono_Casa);
            $command->bindValue(':Telefono_Casa2', $cotitular->Telefono_Casa2);
            $command->bindValue(':Telefono_Celular', $cotitular->Telefono_Celular);
            $command->bindValue(':Telefono_Celular2', $cotitular->Telefono_Celular2);
            $command->bindValue(':Telefono_Celular3', $cotitular->Telefono_Celular3);
            $command->bindValue(':Email', $cotitular->Email);
            $command->bindValue(':Usuario_Creado', Yii::$app->user->identity->email);
            $command->bindValue(':Fecha_Creado', $this->ZonaHoraria());
            $command->bindValue(':Estado', 1);
            $command->execute();

            $model->Codigo_venta = $model->getCodigoVenta();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO venta (Codigo_venta,Codigo_club, Codigo_pasaporte, Codigo_Cliente, numero_contrato, numero_pasaporte, Fecha_Creado,Usuario_Creado, Estado,numero_comprobante,serie_comprobante,salas,razon_social,estado_pago)
                VALUES (:Codigo_venta,:Codigo_club,:Codigo_pasaporte,:Codigo_Cliente,:numero_contrato,:numero_pasaporte,:Fecha_Creado,:Usuario_Creado,:Estado,:numero_comprobante,:serie_comprobante,:salas,:razon_social,:estado_pago)");
            $command->bindValue(':Codigo_venta', $model->Codigo_venta);
            if ($model->Codigo_club == '' || $model->Codigo_club == null) {
                $command->bindValue(':Codigo_club', 999);
            } else {
                $command->bindValue(':Codigo_club', $model->Codigo_club);
            }
            if ($model->Codigo_pasaporte == '' || $model->Codigo_pasaporte == null) {
                $command->bindValue(':Codigo_pasaporte', 999);
            } else {
                $command->bindValue(':Codigo_pasaporte', $model->Codigo_pasaporte);
            }

            $command->bindValue(':Codigo_Cliente', $cliente->Codigo_Cliente);
            $command->bindValue(':numero_contrato', $model->numero_contrato);
            $command->bindValue(':numero_pasaporte', $model->numero_pasaporte);
            $command->bindValue(':Fecha_Creado', $this->ZonaHoraria());
            $command->bindValue(':Usuario_Creado', Yii::$app->user->identity->email);
            $command->bindValue(':Estado', 1);
            $command->bindValue(':numero_comprobante', $model->numero_comprobante);
            $command->bindValue(':serie_comprobante', $model->serie_comprobante);
            if ($model->salas == '' || $model->salas == null) {
                $command->bindValue(':salas', 9);
            } else {
                $command->bindValue(':salas', $model->salas);
            }
            $command->bindValue(':razon_social', $model->razon_social);
            $command->bindValue(':estado_pago', $model->estado_pago);
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
            if ($pago->tipo_pago == '' || $pago->tipo_pago == null) {
                $command->bindValue(':tipo_pago', 1);
            } else {
                $command->bindValue(':tipo_pago', $pago->tipo_pago);
            }
            if ($pago->estado_pago == '' || $pago->estado_pago == null) {
                $command->bindValue(':estado_pago', 1);
            } else {
                $command->bindValue(':estado_pago', $pago->estado_pago);
            }
            $command->bindValue(':monto_pagado', $model->montoTotal);
            $command->bindValue(':monto_ingresado', $pago->monto_ingresado);
            $command->bindValue(':monto_restante', $pago->monto_restante);
            $command->bindValue(':Fecha_Creado', $this->ZonaHoraria());
            $command->bindValue(':Usuario_Creado', Yii::$app->user->identity->email);
            $command->bindValue(':Estado', "1");
            $command->execute();

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('venta',
                    [
                        'estado_pago' => $pago->estado_pago,
                    ],
                    'Codigo_venta = "' . $model->Codigo_venta . '"')
                ->execute();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO comision (
                          Codigo, Codigo_venta, Digitador, OPC, Tienda, SupervisorPromotor, SuperviorGeneralOPC, DirectordeMercadero, TLMK, SupervisordeTLMK, Confirmadora, DirectordeTLMK, Liner, Closer, Closer2, JefedeSala, DirectordeVentas, DirectordeProyectos, GenerenciaGeneral, Fecha_Creado, Estado,Usuario_Creado,
                          Porcen_Digitador, Porcen_OPC, Porcen_Tienda, Porcen_SupervisorPromotor, Porcen_SuperviorGeneralOPC, Porcen_DirectordeMercadero, Porcen_TLMK, Porcen_SupervisordeTLMK, Porcen_Confirmadora, Porcen_DirectordeTLMK, Porcen_Liner, Porcen_Closer, Porcen_Closer2, Porcen_JefedeSala, Porcen_DirectordeVentas, Porcen_DirectordeProyectos, Porcen_GenerenciaGeneral,directordePlaneamiento,asesordePlaneamiento, Porcen_directordePlaneamiento, Porcen_asesordePlaneamiento)
                VALUES ( :Codigo, :Codigo_venta, :Digitador, :OPC, :Tienda, :SupervisorPromotor, :SuperviorGeneralOPC, :DirectordeMercadero, :TLMK, :SupervisordeTLMK, :Confirmadora, :DirectordeTLMK, :Liner, :Closer, :Closer2, :JefedeSala, :DirectordeVentas, :DirectordeProyectos, :GenerenciaGeneral, :Fecha_Creado, :Estado,:Usuario_Creado,
                         :Porcen_Digitador, :Porcen_OPC, :Porcen_Tienda, :Porcen_SupervisorPromotor, :Porcen_SuperviorGeneralOPC, :Porcen_DirectordeMercadero, :Porcen_TLMK, :Porcen_SupervisordeTLMK, :Porcen_Confirmadora, :Porcen_DirectordeTLMK, :Porcen_Liner, :Porcen_Closer, :Porcen_Closer2, :Porcen_JefedeSala, :Porcen_DirectordeVentas, :Porcen_DirectordeProyectos, :Porcen_GenerenciaGeneral,:directordePlaneamiento,:asesordePlaneamiento,:Porcen_directordePlaneamiento,:Porcen_asesordePlaneamiento)");

            $command->bindValue(':Codigo', $comision->getCodigo());
            $command->bindValue(':Codigo_venta', $model->Codigo_venta);
            $command->bindValue(':Fecha_Creado', $this->ZonaHoraria());
            $command->bindValue(':Estado', "1");
            $command->bindValue(':Usuario_Creado', Yii::$app->user->identity->email);

            $command->bindValue(':Digitador', $comision->Digitador);
            $command->bindValue(':OPC', $comision->OPC);
            $command->bindValue(':Tienda', $comision->Tienda);
            $command->bindValue(':SupervisorPromotor', $comision->SupervisorPromotor);
            $command->bindValue(':SuperviorGeneralOPC', $comision->SuperviorGeneralOPC);
            $command->bindValue(':DirectordeMercadero', $comision->DirectordeMercadero);
            $command->bindValue(':TLMK', $comision->TLMK);
            $command->bindValue(':SupervisordeTLMK', $comision->SupervisordeTLMK);
            $command->bindValue(':Confirmadora', $comision->Confirmadora);
            $command->bindValue(':DirectordeTLMK', $comision->DirectordeTLMK);
            $command->bindValue(':Liner', $comision->Liner);
            $command->bindValue(':Closer', $comision->Closer);
            $command->bindValue(':Closer2', $comision->Closer2);
            $command->bindValue(':JefedeSala', $comision->JefedeSala);
            $command->bindValue(':DirectordeVentas', $comision->DirectordeVentas);
            $command->bindValue(':DirectordeProyectos', $comision->DirectordeProyectos);
            $command->bindValue(':GenerenciaGeneral', $comision->GenerenciaGeneral);
            $command->bindValue(':directordePlaneamiento', $comision->directordePlaneamiento);
            $command->bindValue(':asesordePlaneamiento', $comision->asesordePlaneamiento);

            $command->bindValue(':Porcen_Digitador', $comision->comision($model->montoTotal, $comision->Digitador));
            $command->bindValue(':Porcen_OPC', $comision->comision($model->montoTotal, $comision->OPC));
            $command->bindValue(':Porcen_Tienda', $comision->comision($model->montoTotal, $comision->Tienda));
            $command->bindValue(':Porcen_SupervisorPromotor', $comision->comision($model->montoTotal, $comision->SupervisorPromotor));
            $command->bindValue(':Porcen_SuperviorGeneralOPC', $comision->comision($model->montoTotal, $comision->SuperviorGeneralOPC));
            $command->bindValue(':Porcen_DirectordeMercadero', $comision->comision($model->montoTotal, $comision->DirectordeMercadero));
            $command->bindValue(':Porcen_TLMK', $comision->comision($model->montoTotal, $comision->TLMK));
            $command->bindValue(':Porcen_SupervisordeTLMK', $comision->comision($model->montoTotal, $comision->SupervisordeTLMK));
            $command->bindValue(':Porcen_Confirmadora', $comision->comision($model->montoTotal, $comision->Confirmadora));
            $command->bindValue(':Porcen_DirectordeTLMK', $comision->comision($model->montoTotal, $comision->DirectordeTLMK));
            $command->bindValue(':Porcen_Liner', $comision->comision($model->montoTotal, $comision->Liner));
            $command->bindValue(':Porcen_Closer', $comision->comision($model->montoTotal, $comision->Closer));
            $command->bindValue(':Porcen_Closer2', $comision->comision($model->montoTotal, $comision->Closer2));
            $command->bindValue(':Porcen_JefedeSala', $comision->comision($model->montoTotal, $comision->JefedeSala));
            $command->bindValue(':Porcen_DirectordeVentas', $comision->comision($model->montoTotal, $comision->DirectordeVentas));
            $command->bindValue(':Porcen_DirectordeProyectos', $comision->comision($model->montoTotal, $comision->DirectordeProyectos));
            $command->bindValue(':Porcen_GenerenciaGeneral', $comision->comision($model->montoTotal, $comision->GenerenciaGeneral));
            $command->bindValue(':Porcen_directordePlaneamiento', $comision->comision($model->montoTotal, $comision->directordePlaneamiento));
            $command->bindValue(':Porcen_asesordePlaneamiento', $comision->comision($model->montoTotal, $comision->asesordePlaneamiento));
            $command->execute();

            DynamicRelations::relate($cliente, 'beneficiarios', Yii::$app->request->post(), 'Beneficiario', Beneficiario::className());
            DynamicRelations::relate($pago, 'formasPagos', Yii::$app->request->post(), 'FormasPago', FormasPago::className());

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
                'comision' => $comision,
                'cotitular' => $cotitular,

            ]);
        }
    }

    public function actionUpdate($id)
    {
        $CodigoCombo = new Combo();
        $idcombo = $CodigoCombo->getCodigoCombo($id);

        $CodigoComisiones = new Comision();
        $idcomision = $CodigoComisiones->getCodigoComision($id);

        $CodigoPago = new Pago();
        $idPago = $CodigoPago->CodigoPago($id);

        $model = $this->findModel($id);

        $cliente = $this->findModelCliente($model->Codigo_Cliente);
        $incentivos = $this->findModelCombo($idcombo);

        $pago = $this->findModelPago($idPago);
        $comision = $this->findModelComision($idcomision);

        $codigocotitular = new Cotitular();
        $idcotitular = $codigocotitular->getCodigoCotitular($model->Codigo_Cliente);
        $cotitular = $this->findModelCoTitular($idcotitular);

        if ($cotitular->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()) && $comision->load(Yii::$app->request->post()) && $cliente->load(Yii::$app->request->post()) && $incentivos->load(Yii::$app->request->post()) && $pago->load(Yii::$app->request->post())) {

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

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('cotitular',
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

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('venta',
                    [
                        'Codigo_club' => $model->Codigo_club,
                        'Codigo_pasaporte' => $model->Codigo_pasaporte,
                        'Codigo_Cliente' => $cliente->Codigo_Cliente,
                        'numero_contrato' => $model->numero_contrato,
                        'numero_pasaporte' => $model->numero_pasaporte,
                        'numero_comprobante' => $model->numero_comprobante,
                        'serie_comprobante' => $model->serie_comprobante,
                        'salas' => $model->salas,
                        'razon_social' => $model->razon_social,
                        'Fecha_Modificado' => $this->ZonaHoraria(),
                        'Usuario_Modificado' => Yii::$app->user->identity->email,
                    ],
                    'Codigo_venta = ' . $model->Codigo_venta)
                ->execute();

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('combo',
                    [
                        'convetidor1' => $incentivos->convetidor1,
                        'convetidor2' => $incentivos->convetidor2,
                        'Regalos' => $incentivos->Regalos,
                        'Observacion' => $incentivos->Observacion,
                        'Fecha_Modificado' => $this->ZonaHoraria(),
                        'Usuario_Modificado' => Yii::$app->user->identity->email,
                    ],
                    'Codigo_venta = ' . $model->Codigo_venta)
                ->execute();

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('pago',
                    [
                        'codigo_pago' => $pago->codigo_pago,
                        'tipo_pago' => $pago->tipo_pago,
                        'estado_pago' => $pago->estado_pago,
                        'monto_pagado' => $model->montoTotal,
                        'monto_ingresado' => $pago->monto_ingresado,
                        'monto_restante' => $pago->monto_restante,

                        'Fecha_Modificado' => $this->ZonaHoraria(),
                        'Usuario_Modificado' => Yii::$app->user->identity->email,
                    ],
                    'Codigo_venta = ' . $model->Codigo_venta)
                ->execute();

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('venta',
                    [
                        'estado_pago' => $pago->estado_pago,
                    ],
                    'Codigo_venta = "' . $model->Codigo_venta . '"')
                ->execute();


            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('comision',
                    [
                        'Codigo_venta' => $model->Codigo_venta,

                        'Digitador' => $comision->Digitador,
                        'OPC' => $comision->OPC,
                        'Tienda' => $comision->Tienda,
                        'SupervisorPromotor' => $comision->SupervisorPromotor,
                        'SuperviorGeneralOPC' => $comision->SuperviorGeneralOPC,
                        'DirectordeMercadero' => $comision->DirectordeMercadero,
                        'TLMK' => $comision->TLMK,
                        'SupervisordeTLMK' => $comision->SupervisordeTLMK,
                        'Confirmadora' => $comision->Confirmadora,
                        'DirectordeTLMK' => $comision->DirectordeTLMK,
                        'Liner' => $comision->Liner,
                        'Closer' => $comision->Closer,
                        'Closer2' => $comision->Closer2,
                        'JefedeSala' => $comision->JefedeSala,
                        'DirectordeVentas' => $comision->DirectordeVentas,
                        'DirectordeProyectos' => $comision->DirectordeProyectos,
                        'GenerenciaGeneral' => $comision->GenerenciaGeneral,
                        'Fecha_Modificado' => $this->ZonaHoraria(),
                        'Usuario_Modificado' => Yii::$app->user->identity->email,
                        'directordePlaneamiento' => $comision->directordePlaneamiento,
                        'asesordePlaneamiento' => $comision->asesordePlaneamiento,

                        'Porcen_Digitador' => $comision->comision($model->montoTotal, $comision->Digitador),
                        'Porcen_OPC' => $comision->comision($model->montoTotal, $comision->OPC),
                        'Porcen_Tienda' => $comision->comision($model->montoTotal, $comision->Tienda),
                        'Porcen_SupervisorPromotor' => $comision->comision($model->montoTotal, $comision->SupervisorPromotor),
                        'Porcen_SuperviorGeneralOPC' => $comision->comision($model->montoTotal, $comision->SuperviorGeneralOPC),
                        'Porcen_DirectordeMercadero' => $comision->comision($model->montoTotal, $comision->DirectordeMercadero),
                        'Porcen_TLMK' => $comision->comision($model->montoTotal, $comision->TLMK),
                        'Porcen_SupervisordeTLMK' => $comision->comision($model->montoTotal, $comision->SupervisordeTLMK),
                        'Porcen_Confirmadora' => $comision->comision($model->montoTotal, $comision->Confirmadora),
                        'Porcen_DirectordeTLMK' => $comision->comision($model->montoTotal, $comision->DirectordeTLMK),
                        'Porcen_Liner' => $comision->comision($model->montoTotal, $comision->Liner),
                        'Porcen_Closer' => $comision->comision($model->montoTotal, $comision->Closer),
                        'Porcen_Closer2' => $comision->comision($model->montoTotal, $comision->Closer2),
                        'Porcen_JefedeSala' => $comision->comision($model->montoTotal, $comision->JefedeSala),
                        'Porcen_DirectordeVentas' => $comision->comision($model->montoTotal, $comision->DirectordeVentas),
                        'Porcen_DirectordeProyectos' => $comision->comision($model->montoTotal, $comision->DirectordeProyectos),
                        'Porcen_GenerenciaGeneral' => $comision->comision($model->montoTotal, $comision->GenerenciaGeneral),
                        'Porcen_directordePlaneamiento' => $comision->comision($model->montoTotal, $comision->directordePlaneamiento),
                        'Porcen_asesordePlaneamiento' => $comision->comision($model->montoTotal, $comision->asesordePlaneamiento),

                    ],
                    'Codigo = ' . $idcomision)
                ->execute();

            $model->SP_Delete($model->Codigo_Cliente);
            DynamicRelations::relate($cliente, 'beneficiarios', Yii::$app->request->post(), 'Beneficiario', Beneficiario::className());
            $model->SP_DeletePago($pago->codigo_pago);
            DynamicRelations::relate($pago, 'formasPagos', Yii::$app->request->post(), 'FormasPago', FormasPago::className());

            return $this->redirect(['view', 'id' => $model->Codigo_venta]);

        } else {
            return $this->render('update', [
                'model' => $model,
                'cliente' => $cliente,
                'incentivos' => $incentivos,
                'pago' => $pago,
                'comision' => $comision,
                'cotitular' => $cotitular,
            ]);
        }
    }

    public function actionCobranzas($id)
    {
        $CodigoCombo = new Combo();
        $idcombo = $CodigoCombo->getCodigoCombo($id);

        $CodigoComisiones = new Comision();
        $idcomision = $CodigoComisiones->getCodigoComision($id);

        $CodigoPago = new Pago();
        $idPago = $CodigoPago->CodigoPago($id);

        $model = $this->findModel($id);

        $cliente = $this->findModelCliente($model->Codigo_Cliente);
        $incentivos = $this->findModelCombo($idcombo);

        $pago = $this->findModelPago($idPago);
        $comision = $this->findModelComision($idcomision);

        $codigocotitular = new Cotitular();
        $idcotitular = $codigocotitular->getCodigoCotitular($model->Codigo_Cliente);
        $cotitular = $this->findModelCoTitular($idcotitular);

        if ($cotitular->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()) && $comision->load(Yii::$app->request->post()) && $cliente->load(Yii::$app->request->post()) && $incentivos->load(Yii::$app->request->post()) && $pago->load(Yii::$app->request->post())) {

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

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('cotitular',
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

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('venta',
                    [
                        'Codigo_club' => $model->Codigo_club,
                        'Codigo_pasaporte' => $model->Codigo_pasaporte,
                        'Codigo_Cliente' => $cliente->Codigo_Cliente,
                        'numero_contrato' => $model->numero_contrato,
                        'numero_pasaporte' => $model->numero_pasaporte,
                        'numero_comprobante' => $model->numero_comprobante,
                        'serie_comprobante' => $model->serie_comprobante,
                        'salas' => $model->salas,
                        'razon_social' => $model->razon_social,
                        'Fecha_Modificado' => $this->ZonaHoraria(),
                        'Usuario_Modificado' => Yii::$app->user->identity->email,
                    ],
                    'Codigo_venta = ' . $model->Codigo_venta)
                ->execute();

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('combo',
                    [
                        'convetidor1' => $incentivos->convetidor1,
                        'convetidor2' => $incentivos->convetidor2,
                        'Regalos' => $incentivos->Regalos,
                        'Observacion' => $incentivos->Observacion,
                        'Fecha_Modificado' => $this->ZonaHoraria(),
                        'Usuario_Modificado' => Yii::$app->user->identity->email,
                    ],
                    'Codigo_venta = ' . $model->Codigo_venta)
                ->execute();

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('pago',
                    [
                        'codigo_pago' => $pago->codigo_pago,
                        'tipo_pago' => $pago->tipo_pago,
                        'estado_pago' => $pago->estado_pago,
                        'monto_pagado' => $model->montoTotal,
                        'monto_ingresado' => $pago->monto_ingresado,
                        'monto_restante' => $pago->monto_restante,

                        'Fecha_Modificado' => $this->ZonaHoraria(),
                        'Usuario_Modificado' => Yii::$app->user->identity->email,
                    ],
                    'Codigo_venta = ' . $model->Codigo_venta)
                ->execute();

            $transaction = Yii::$app->db;
            $transaction->createCommand()
                ->update('venta',
                    [
                        'estado_pago' => $pago->estado_pago,
                    ],
                    'Codigo_venta = "' . $model->Codigo_venta . '"')
                ->execute();
            
            $model->SP_Delete($model->Codigo_Cliente);
            DynamicRelations::relate($cliente, 'beneficiarios', Yii::$app->request->post(), 'Beneficiario', Beneficiario::className());
            $model->SP_DeletePago($pago->codigo_pago);
            DynamicRelations::relate($pago, 'formasPagos', Yii::$app->request->post(), 'FormasPago', FormasPago::className());

            return $this->redirect(['vista', 'id' => $model->Codigo_venta]);

        } else {
            return $this->render('cobranzas', [
                'model' => $model,
                'cliente' => $cliente,
                'incentivos' => $incentivos,
                'pago' => $pago,
                'comision' => $comision,
                'cotitular' => $cotitular,
            ]);
        }
    }

    public function actionDelete($id)
    {

        $model = new Venta();
        $model->SP_DeleteContrato($id);
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
            echo "<i class=\"fa fa-spinner fa-spin fa-2x fa-fw\"></i> Debe Ingresar Codigo Pasaporte.";
            exit();
        } elseif (Empty($_POST['codigocertificado'])) {
            echo "<i class=\"fa fa-spinner fa-spin fa-2x fa-fw\"></i> Debe Ingresar Codigo Certificado.";
            exit();
        } else {
            $codigopasaporte = $_POST['codigopasaporte'];
            $codigocertificado = $_POST['codigocertificado'];
        }

        $transaction = Yii::$app->db;
        $transaction->createCommand()
            ->update('certificado',
                [
                    'Estado' => 2,
                    'Codigo_pasaporte' => $codigopasaporte
                ],
                'codigo_barra = "' . $codigocertificado . '"')
            ->execute();

        $connection = Yii::$app->db;
        $sqlStatement = "SELECT codigo_barra FROM certificado WHERE Codigo_pasaporte = '" . $codigopasaporte . "'";
        $comando = $connection->createCommand($sqlStatement);
        $resultado = $comando->query();

        while ($row = $resultado->read()) {
            echo $row['codigo_barra'];
            echo " - ";
        }
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

    public function actionCantidad()
    {
        if (Empty($_POST['value'])) {
            exit();
        } else {
            $codigo = $_POST['value'];
        }
        $query = new Query();
        $select = new Expression("Dias_noches");
        $where = new Expression("Codigo_club = '" . $codigo . "'");
        $query->select($select)->from('club')->where($where);
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

    protected function findModelCliente($id)
    {
        if (($cliente = Cliente::findOne($id)) !== null) {
            return $cliente;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelCoTitular($id)
    {
        if (($cotitular = Cotitular::findOne($id)) !== null) {
            return $cotitular;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelCertificado($id)
    {
        if (($model = Certificado::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelCombo($id)
    {
        if (($model = Combo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelPago($id)
    {
        if (($model = Pago::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelFormaPago($id)
    {
        if (($model = FormasPago::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelComision($id)
    {
        if (($model = Comision::findOne($id)) !== null) {
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

            $fechaIni = substr($model->Fecha_Creado, 6, 4) . '-' . substr($model->Fecha_Creado, 3, 2) . '-' . substr($model->Fecha_Creado, 0, 2); //'2016-06-09' ;
            $fechaFin = substr($model->Fecha_Eliminado, 6, 4) . '-' . substr($model->Fecha_Eliminado, 3, 2) . '-' . substr($model->Fecha_Eliminado, 0, 2); //'2016-06-09' ;

            $combo = $model->Selectcombo;       //combo
            $estadoPago = $model->estado_pago;  // estado
            $sala = $model->sala;               // sala
            $codigoClub = $model->Codigo_club;  // codigo club
            $usuario = $model->usuario;         // usuario
            $reporte = $model->reporte;         // reporte

            if ($reporte == 0) { // excel
                return $this->render('reporteventaexcel', [
                    'fechaIni' => $fechaIni,
                    'fechaFin' => $fechaFin,
                    'combo' => $combo,
                    'estadoPago' => $estadoPago,
                    'sala' => $sala,
                    'codigoClub' => $codigoClub,
                    'usuario' => $usuario,
                ]);
            } else { // PDF
                return $this->render('reporteventa', [
                    'fechaIni' => $fechaIni,
                    'fechaFin' => $fechaFin,
                    'combo' => $combo,
                    'estadoPago' => $estadoPago,
                    'sala' => $sala,
                    'codigoClub' => $codigoClub,
                    'usuario' => $usuario,
                ]);
            }

        } else {
            return $this->render('venta', [
                'model' => $model,
            ]);
        }
    }

    public function actionCodigosala()
    {

        if (Empty($_POST['codsala'])) {
            exit();
        } else {
            $codigo = $_POST['codsala'];
        }
        $query = new Query();
        $select = new Expression("codigo_barra");
        $where = new Expression("sala = '" . $codigo . "' and Estado = 1 ");
        $query->select($select)->from('detalle_pasaporte')->where($where)->limit(1);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();

        $transaction = Yii::$app->db;
        $transaction->createCommand()
            ->update('detalle_pasaporte',
                [
                    'Estado' => '2',
                    'FECH_SOLIC' => $this->ZonaHoraria()
                ],
                'codigo_barra = "' . $data . '" ')
            ->execute();

        echo $data;
    }

    public function actionCantidadscan()
    {
        if (Empty($_POST['codigobarra'])) {
            exit();
        } else {
            $codigo = $_POST['codigobarra'];
        }
        $query = new Query();
        $select = new Expression("count(*)");
        $where = new Expression("Codigo_pasaporte = '" . $codigo . "' and Estado = 2 ");
        $query->select($select)->from('certificado')->where($where)->limit(1);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        echo $data;
    }

}
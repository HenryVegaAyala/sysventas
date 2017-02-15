<?php

namespace app\controllers;

use app\models\Beneficiario;
use Yii;
use app\models\Cliente;
use app\models\ClienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use synatree\dynamicrelations\DynamicRelations;

class ClienteController extends Controller
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


    /**
     * @decripcion Lista de Clientes perzonalizada por filtros de ClienteSearch
     * @primer filtro trae: 'Lista de todos los clientes menos los eliminados'
     *
     */
    public function actionIndex()
    {
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @decripcion Lista de Clientes perzonalizada por filtros de ClienteSearch
     * @primer filtro trae: 'Lista de todos los clientes menos los eliminados'
     *
     */
    public function actionLista()
    {
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('lista', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @decripcion Vista Detallada de cliente
     *
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @decripcion Vista Detallada de cliente
     *
     */
    public function actionVista($id)
    {
        return $this->render('vista', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @decripcion Agregar Nuevo Cliente
     *
     */
    public function actionCreate()
    {
        $model = new Cliente();

        if ($model->load(Yii::$app->request->post())) {

            $nombre = $model->Nombre;
            $apellido = $model->Apellido;

            $dato = $nombre . ' ' . $apellido;

            $datoValidado = $model->NombreValidador($dato);

            if ($datoValidado == 1) {
                Yii::$app->session->setFlash('error', 'Este Cliente ya fue registrado anteriormente.');
                return $this->render('create', ['model' => $model,]);
            } else {
                $model->Codigo_Cliente = $model->getCodigoCliente();
                $model->Fecha_Creado = $this->ZonaHoraria();
                $model->Estado = '1'; // estado clientes creado
                $model->Usuario_Creado = Yii::$app->user->identity->email;
                $model->save();
                DynamicRelations::relate($model, 'beneficiarios', Yii::$app->request->post(), 'Beneficiario', Beneficiario::className());
                Yii::$app->session->setFlash('success', 'Se ha registrado exitosamente al Cliente.');
                return $this->redirect(['lista']);
            }
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
            $Codigo = $model->Codigo_Cliente;
            $model->SP_Delete($Codigo);
            DynamicRelations::relate($model, 'beneficiarios', Yii::$app->request->post(), 'Beneficiario', Beneficiario::className());
//            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionAgendar($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $Codigo = $model->Codigo_Cliente;
            $estado = $model->Estado; //Estado 3 Cita Pendiente y pasa a agendar
            $fecha = $model->Agendado;

            $model->Agendar($fecha, $estado, $Codigo);

            return $this->redirect(['asig-tlmk-cliente/index']);
        } else {
            return $this->render('agendar', [
                'model' => $model,
            ]);
        }
    }

    public function actionConfirmador()
    {
        $searchModel = new ClienteSearch();
        if (Yii::$app->user->identity->Codigo_Rol = 10) {
            $dataProvider = $searchModel->search2(Yii::$app->request->getQueryParams());
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        }
        return $this->render('confirmador', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionConfirmar($id)
    {
        $model = $this->findModel($id);
        $Codigo = $model->Codigo_Cliente;
        $model->SP_Confirmar($Codigo);
        return $this->redirect('confirmador');
    }

    public function actionDesafiliar($id)
    {
        $model = $this->findModel($id);
        return $this->redirect('confirmador');
    }

    public function actionDelete($id)
    {
        $model = new Cliente();
        $fh_delete = $this->ZonaHoraria();
        $estado = '0'; // Estado Eliminado
        $usuario = Yii::$app->user->identity->email;
        $model->ActualizarUsuario($id, $fh_delete, $usuario, $estado);
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Cliente::findOne($id)) !== null) {
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

}

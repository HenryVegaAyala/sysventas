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

    public function actionIndex()
    {
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLista()
    {
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('lista', [
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

    public function actionVista($id)
    {
        return $this->render('vista', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Cliente();

        if ($model->load(Yii::$app->request->post())) {

            $model->Codigo_Cliente = $model->getCodigoCliente();
            $model->Fecha_Creado = $this->ZonaHoraria();
            $model->Estado = '10';
            $model->Usuario_Creado = Yii::$app->user->identity->email;
            $model->save();
            DynamicRelations::relate($model, 'beneficiarios', Yii::$app->request->post(), 'Beneficiario', Beneficiario::className());
            Yii::$app->session->setFlash('success', 'Se ha registrado exitosamente.');
            return $this->redirect(['create']);
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
            $estado = $model->Estado;
            $fecha = $model->Agendado;
//            var_dump($Codigo,$estado,$fecha);exit();
            $model->Agendar($fecha,$estado,$Codigo);
//            var_dump( $model->Agendado.':20');exit();
//            $model->save();
            return $this->redirect(['asig-tlmk-cliente/index']);
        } else {
            return $this->render('agendar', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = new Cliente();
        $fh_delete = $this->ZonaHoraria();
        $estado = '0';
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

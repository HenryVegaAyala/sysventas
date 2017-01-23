<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class UsuarioController extends Controller
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
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

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
        $model = new Usuario();
        $mensaje = null;

        if ($model->load(Yii::$app->request->post())) {

            $model->Codigo_Usuario = $model->getCodigoUsuario();
            $model->Fecha_Creado = $this->ZonaHoraria();
            $model->Estado = '1';
            $model->Usuario_Creado = Yii::$app->user->identity->Email;
            $model->AuthKey = $this->randKey("abcdef0123456789", 200);
            $model->AccessToken = $this->randKey("abcdef0123456789", 200);

            if ($model->Email == $model->getEmailExistente($model->Email)) {
                $mensaje = "Ya se utilizo este correo para este usurio";
                return $this->render('create', ['model' => $model, 'mensaje' => $mensaje,]);
            }

            $model->save();
            return $this->redirect(['index']);

        } else {
            return $this->render('create', [
                'model' => $model,
                'mensaje' => $mensaje,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->Fecha_Modificada = $this->ZonaHoraria();
            $model->Usuario_Modificado = Yii::$app->user->identity->Email;
            $model->save();
            
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = new Usuario;
        $fh_delete = $this->ZonaHoraria();
        $estado = '0';
        $usuario = Yii::$app->user->identity->Email;
        $model->ActualizarUsuario($id,$fh_delete,$usuario,$estado);
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
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

    private function randKey($str = '', $long = 0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str) - 1;
        for ($x = 0; $x < $long; $x++) {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }

    private function cryptKey($pass, $params)
    {
        $passEncryt = crypt($pass, $params);

        return $passEncryt;

    }
}

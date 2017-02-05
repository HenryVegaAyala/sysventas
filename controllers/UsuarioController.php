<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dektrium\user\helpers\Password;


class UsuarioController extends Controller
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
        $searchModel = new UsuarioSearch;
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
        $model = new Usuario;
        $mensaje = null;
        if ($model->load(Yii::$app->request->post())) {

            $correo = $model->email;
            $correoValidado = $model->EmailValidador($correo);

            if ($correoValidado == 1) {
                Yii::$app->session->setFlash('error', 'Este email ya fue registrado anteriormente.');
                return $this->render('create', ['model' => $model,]);
            } else if ($model->password_hash !== $model->password_repeat){
                Yii::$app->session->setFlash('error', 'Las contraseñas no coinciden.');
                return $this->render('create', ['model' => $model,]);
            }else{
                $codigo = ($model->id = $model->getCodigoUsuario());
                $usuario = $model->username;
                $email = $model->email;
                $passEncryt = $model->password_hash = Password::hash($model->password_hash);
                $roles = ($model->Codigo_Rol = $model->auth_key);
                $status = $model->status;
                $Fecha_Crea = ($model->Fecha_Creado = $this->ZonaHoraria());
                $usu_crea = ($model->Usuario_Creado = Yii::$app->user->identity->email);
                $passDes = ($model->pwdDes = $model->password_repeat);
                $estado = ($model->estado = '2'); //Son de 2 nivel no privilegiados

                $rol = $model->Codigo_Rol;
                $valor = $model->getRol($rol);
//                $model->InsertUsuario($codigo, $usuario, $email, $passEncryt, $Fecha_Crea, $usu_crea, $roles, $estado, $passDes,$status,$rol);
                $model->CrearPrivilegioDeRol($valor, $codigo);
                $model->save();
                Yii::$app->session->setFlash('success', 'Este cuenta se ha registrado exitosamente.');
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = new Usuario;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $Codigo = $model->id;
            $PassDes = $model->pwdDes = $model->password_hash;
            $PassEncryt = Password::hash($model->password_hash);
            $Fecha_Modi = $model->Fecha_Modificada = $this->ZonaHoraria();
            $Usu_Modi = $model->Usuario_Modificado = Yii::$app->user->identity->email;
            $Cod_Rol = $model->auth_key;

            $model->ActualizarPass($Codigo, $PassDes, $PassEncryt, $Fecha_Modi, $Usu_Modi, $Cod_Rol);
            $model->EliminarAsignacion($Codigo);
            $model->ActualizarAsignacion($Codigo,$Cod_Rol);
//            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = new Usuario();

        $pass = $model->password_hash = '';
        $Fecha_Eli = $model->Fecha_Eliminada = $this->ZonaHoraria();
        $Usu_Eli = $model->Usuario_Eliminado = Yii::$app->user->identity->email;

        $model->EliminarUsuario($id, $pass, $Fecha_Eli, $Usu_Eli);

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

}
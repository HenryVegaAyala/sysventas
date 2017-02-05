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

        if ($model->load(Yii::$app->request->post())) {

            $codigo = $model->id = $model->getCodigoUsuario();
            $model->pwdDes = $model->password_hash;
            $model->password_hash = Password::hash($model->password_hash);
            $model->Fecha_Creado = $this->ZonaHoraria();
            $model->estado = '2'; //Son de 2 nivel no privilegiados
            $rol = $model->Codigo_Rol = $model->auth_key;
            $model->Usuario_Creado = Yii::$app->user->identity->email;

            $rol = $model->Codigo_Rol;
            $valor = $model->getRol($rol);
            $model->CrearPrivilegioDeRol($valor,$codigo);
            $model->save();
            
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
            $PassDes = $model->pwdDes = $model->password_hash;
            $PassEncryt = Password::hash($model->password_hash);
            $Fecha_Modi = $model->Fecha_Modificada = $this->ZonaHoraria();
            $Usu_Modi = $model->Usuario_Modificado = Yii::$app->user->identity->email;
            $Cod_Rol = $model->auth_key;

            $model->password_hash = $this->ActualizarPass($Codigo, $PassDes, $PassEncryt, $Fecha_Modi, $Usu_Modi,$Cod_Rol);
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

    public function ActualizarPass($Codigo, $PassDes, $PassEncryt, $Fecha_Modi, $Usu_Modi,$Cod_Rol)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("UPDATE user SET 
                            password_hash = '" . $PassEncryt . "',
                            Usuario_Modificado = '" . $Usu_Modi . "',
                            Fecha_Modificada = '" . $Fecha_Modi . "',
                            pwdDes = '" . $PassDes . "',
                            Codigo_Rol = '".$Cod_Rol."'
                            WHERE id = '" . $Codigo . "';")->execute();
        $transaction->commit();

    }

}
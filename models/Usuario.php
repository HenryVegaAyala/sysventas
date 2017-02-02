<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $Codigo_Usuario
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Email
 * @property string $Contrasena
 * @property string $AuthKey
 * @property string $AccessToken
 * @property integer $Activate
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificada
 * @property string $Fecha_Eliminada
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Ultima_Sesion
 * @property string $Estado
 * @property integer $Codigo_Rol
 *
 * @property Rol $codigoRol
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $password_repeat;

    public static function tableName()
    {
        return 'usuario';
    }

    public function rules()
    {
        return [
            [['Codigo_Usuario', 'Codigo_Rol', 'Nombre', 'Apellido', 'Email', 'Contrasena', 'password_repeat'], 'required', 'message' => 'Este campo es requerido'],
            [['Codigo_Usuario', 'Activate', 'Codigo_Rol'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificada', 'Fecha_Eliminada', 'Ultima_Sesion'], 'safe'],
            [['Nombre', 'Apellido', 'Email'], 'string', 'max' => 45],
            [['Contrasena', 'AuthKey', 'AccessToken', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 250],
            [['Estado'], 'string', 'max' => 1],
            [['Codigo_Rol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['Codigo_Rol' => 'Cod_Rol']],

            ['Nombre', 'match', 'pattern' => "/^.{1,50}$/", 'message' => 'Mínimo 1 caracter'],
//            ['Nombre', 'username_existe'],

            ['Email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['Email', 'email', 'message' => 'Formato de correo no válido'],
//            ['Email', 'email_existe'],

            ['Contrasena', 'match', 'pattern' => "/^.{6,250}$/", 'message' => 'Mínimo 6 y máximo 16 caracteres'],
            ['password_repeat', 'compare', 'compareAttribute' => 'Contrasena', 'message' => 'Los passwords no coinciden'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Codigo_Usuario' => 'Codigo  Usuario',
            'Nombre' => 'Nombres',
            'Apellido' => 'Apellidos',
            'Email' => 'Email',
            'Contrasena' => 'Contraseña',
            'AuthKey' => 'Auth Key',
            'AccessToken' => 'Access Token',
            'Activate' => 'Activate',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificada' => 'Fecha  Modificada',
            'Fecha_Eliminada' => 'Fecha  Eliminada',
            'Ultima_Sesion' => 'Ultima  Sesion',
            'password_repeat' => 'Repetir Contraseña',
            'Estado' => 'Estado',
            'Codigo_Rol' => 'Rol',
        ];
    }

    public function getCodigoRol()
    {
        return $this->hasOne(Rol::className(), ['Cod_Rol' => 'Codigo_Rol']);
    }

    public function email_existe($attribute, $params)
    {
        //Buscar el email en la tabla
        $table = Usuario::find()->where("Email=:Email", [":Email" => $this->Email]);

        //Si el email existe mostrar el error
        if ($table->count() == 1) {
            $this->addError($attribute, "El email seleccionado existe");
        }
    }

    public function username_existe($attribute, $params)
    {
        //Buscar el username en la tabla
        $table = Usuario::find()->where("Nombre=:Nombre", [":Nombre" => $this->Nombre]);

        //Si el username existe mostrar el error
        if ($table->count() == 1) {
            $this->addError($attribute, "El usuario seleccionado existe");
        }
    }

    public function getCodigoUsuario()
    {
        $query = new Query();
        $query->select('max(Codigo_Usuario) + 1 as Codigo')->from('usuario');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getEmailExistente($email)
    {
        $query = new Query();
        $query->select('Email')->from('usuario')->where(['Email' => "$email"]);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function ActualizarUsuario($id, $fh_delete,$usuario,$estado)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("UPDATE usuario SET 
                            Fecha_Eliminada='" . $fh_delete . "',
                            Estado = '" . $estado . "',
                            Usuario_Eliminado = '" . $usuario . "'  
                            WHERE Codigo_Usuario = '" . $id . "';")->execute();
        $transaction->commit();

    }

    public function getRol()
    {
        $resultado = ArrayHelper::map(Rol::find()->orderBy('Descripcion asc')->where('estado = 1')->asArray()->all(), 'Cod_Rol', 'Descripcion');
        return $resultado;
    }

    public function getEstado()
    {
        $var = [ 0 => 'Inactivo', 1 => 'Activo'];
        return $var;
    }

}
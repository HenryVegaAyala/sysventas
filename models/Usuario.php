<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $last_login_at
 * @property integer $status
 * @property string $password_reset_token
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificada
 * @property string $Fecha_Eliminada
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Ultima_Sesion
 * @property integer $Codigo_Rol
 * @property string $pwdDes
 * @property integer $estado
 */
class Usuario extends \yii\db\ActiveRecord
{

    public $password_repeat;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'password_repeat'], 'required'],
            [['id', 'confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'last_login_at', 'status', 'Codigo_Rol'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificada', 'Fecha_Eliminada', 'Ultima_Sesion'], 'safe'],
            [['username', 'email', 'password_hash', 'unconfirmed_email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['password_reset_token'], 'string', 'max' => 256],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 250],
            [['username'], 'unique'],
            [['email'], 'unique'],

            ['username', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 caracteres del Nombre del Usuario'],
//            ['Nombre', 'username_existe'],

            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato de correo no válido'],
//            ['Email', 'email_existe'],

            ['password_hash', 'match', 'pattern' => "/^.{6,255}$/", 'message' => 'Mínimo 6 caracteres para la contraseña'],
//            ['password_hashpwdDes', 'compare', 'compareAttribute' => 'pwdDes', 'message' => 'Las contraseñas no coinciden.'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Nombre de Usuario',
            'email' => 'Correo Electrónico',
            'password_hash' => 'Contraseña',
            'password_repeat' => 'Repetir Contraseña',
            'auth_key' => 'Rol Autorizado',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_login_at' => 'Last Login At',
            'status' => 'Estado',
            'password_reset_token' => 'Password Reset Token',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificada' => 'Fecha  Modificada',
            'Fecha_Eliminada' => 'Fecha  Eliminada',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Ultima_Sesion' => 'Ultima  Sesion',
            'Codigo_Rol' => 'Codigo  Rol',
        ];
    }

    public function getRol($rol)
    {
        switch ($rol) {
            case 1:
                return 'Digitador';
                break;
            case 2:
                return 'Supervisor';
                break;
            case 3:
                return 'Anfitrión';
                break;
            case 4:
                return 'Director de mercadeo';
                break;
            case 5:
                return 'Telemarketing';
                break;
            case 6:
                return 'Confirmador';
                break;
            case 7:
                return 'Supervisora de telemarketing';
                break;
            case 8:
                return 'No access liner';
                break;
            case 9:
                return 'No access closer';
                break;
            case 10:
                return 'Jefe de contratos';
                break;
            case 11:
                return 'Jefe de sala';
                break;
            case 12:
                return 'Jefe de ventas';
                break;
            case 13:
                return 'Director de proyecto';
                break;
            case 14:
                return 'Gerente General';
                break;
            case 20:
                return 'Administrador';
                break;
            default:
                return 'Sin permiso';
        }
    }

    public function getCodigoUsuario()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(id), 0) + 1');
        $query->select($expresion)->from('user');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getEstado()
    {
        $var = [
            1 => 'Activo',
            0 => 'Inactivo',
        ];
        return $var;
    }

    public function getRoles($IdRol)
    {

        $where = $this->getPrivilegios($IdRol);

        $resultado = ArrayHelper::map(
            Usuario::find()
                ->orderBy('id desc')
                ->where($where)->asArray()
                ->all(), 'Codigo_Rol', 'username');
        return $resultado;
    }

    public function getPrivilegios($rol)
    {
        switch ($rol) {
            case 2: // supervisor
                $where = new Expression('status = 1 and Codigo_Rol in (1,3,6)');
                return $where;
                break;
            case 10:
                $where = new Expression('status = 1');
                return $where;
                break;
            case 11:
                $where = new Expression('status = 1 and Codigo_Rol in (1,2,3)');
                return $where;
                break;
            case 12:
                $where = new Expression('status = 1 and Codigo_Rol in (1,2,3)');
                return $where;
                break;
            case 13:
                $where = new Expression('status = 1');
                return $where;
                break;
            case 14:
                $where = new Expression('status = 1');
                return $where;
                break;
            case 20:
                $where = new Expression('status = 1');
                return $where;
        }
    }

    public function getFiltros($rol)
    {
        switch ($rol) {
            case 2: // supervisor
                $where = new Expression('estado = 2 and Codigo_Rol in (1,3,6)');
                return $where;
                break;
            case 10: //jefe de contratos
                $where = new Expression('status = 1');
                return $where;
                break;
            case 11: //jefe de sala
                $where = new Expression('estado = 2 and Codigo_Rol in (2,3)');
                return $where;
                break;
            case 12: //jefe de ventas
                $where = new Expression('estado = 2 and Codigo_Rol in (1,2,3)');
                return $where;
                break;
            case 13: //Director de proyecto
                $where = new Expression('status = 1');
                return $where;
                break;
            case 14: //Director General
                $where = new Expression('status = 1');
                return $where;
                break;
            case 20:
                $where = new Expression('status = 1');
                return $where;
        }
    }

    public function EliminarUsuario($Codigo, $pass, $Fecha_Eli, $Usu_Eli)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("UPDATE user SET 
                            password_hash = '" . $pass . "',
                            Fecha_Eliminada = '" . $Fecha_Eli . "',
                            Usuario_Eliminado = '" . $Usu_Eli . "',
                            estado = '0'
                            WHERE id = '" . $Codigo . "';")->execute();
        $transaction->commit();

    }

    public function CrearPrivilegioDeRol($Rol, $Codigo)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("INSERT INTO auth_assignment (item_name, user_id) VALUES ('" . $Rol . "','" . $Codigo . "');")->execute();
        $transaction->commit();

    }
}
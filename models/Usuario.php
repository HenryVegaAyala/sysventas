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
 * @property string id_personal
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
            [['username', 'email', 'password_hash', 'password_repeat', 'auth_key', 'status'], 'required'],
            [['id_personal'], 'required', 'message' => 'ID Personal es requrido.'],
            [['id', 'confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'last_login_at', 'status', 'Codigo_Rol'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificada', 'Fecha_Eliminada', 'Ultima_Sesion'], 'safe'],
            [['username', 'email', 'password_hash', 'unconfirmed_email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['password_reset_token'], 'string', 'max' => 256],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 250],
//            [['email'], 'unique'],
            ['username', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 caracteres del Nombre del Usuario'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato de correo no válido'],
            ['password_hash', 'match', 'pattern' => "/^.{6,255}$/", 'message' => 'Mínimo 6 caracteres para la contraseña'],
//            ['password_repeat', 'compare', 'compareAttribute' => 'password_hash', 'message' => 'Las contraseñas no coinciden.'],

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
            'id_personal' => 'Identificación Personal',
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
            case 15:
                return 'Supervisor Promotor';
                break;
            case 16:
                return 'Jefe Promotor';
                break;
            case 17:
                return 'Director de Telemarketing';
                break;
            case 18:
                return 'Director de Planemiento y Administracion';
                break;
            case 19:
                return 'Director Comercial';
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

    // Aqui hace un filtro de de roles en el dropdownlist
    /**
     * @param $IdRol                Este es Codigo_Rol que pertenece a cada jefe
     * @return array
     */
    public function getRoles($IdRol)
    {

        $where = $this->getPrivilegios($IdRol);

        $resultado = ArrayHelper::map(
            Usuario::find()
                ->where($where)->asArray()
                ->all(), 'Codigo_Rol', 'username');
        return $resultado;
    }

    // Aqui son los filtros del privilegios
    /**
     * @param $rol              Codigo_Rol director
     * @return Expression       return un where
     *
     * case 4: Director de mercadeo       estado 1,15,16
     * case 17: Director de Telemarketing estado 5,7
     */
    public function getPrivilegios($rol)
    {
        switch ($rol) {
            case 2: // supervisor
                $where = new Expression('status = 1 and Codigo_Rol in (2)');
                return $where;
                break;
            case 4: // Director de mercadeo
                $where = new Expression('Codigo_Rol in (1,15,16) and status = 1 and estado = 1');
                return $where;
                break;
            case 10: //jefe de contratos
                $where = new Expression('status = 1 and Codigo_Rol in (1,2,3)'); //combo de usuarios
                return $where;
                break;
            case 11:
                $where = new Expression('status = 1 and Codigo_Rol in (1,2,3)');
                return $where;
                break;
            case 12: // jefe de ventas
                $where = new Expression('estado = 1 and Codigo_Rol in (1,2,3)');
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
            case 17: // Director de Telemarketing
                $where = new Expression('Codigo_Rol in (5,7) and status = 1 and estado = 1');
                return $where;
                break;
            case 20: // administrador
                $where = new Expression('status = 1 and estado = 1');
                return $where;
        }
    }

    // Ayuda a filtrar la lista de clientes
    /**
     * @param $CodigoRol            Codigo Rol del Usuario
     * @param $CodigoUsuario        Codigo Usuario del Usuario
     * @return Expression           return un where
     *
     * case 1: Digitador estado a mostrar todos
     * case 4: Director de mercadeo estado a mostrar 1,15,16
     * case 5: Telemarketing estado mostrar 9
     * case 17: Director de Telemarketing mostrar 5,7
     */
    public function getFiltros($CodigoRol, $CodigoUsuario)
    {
        switch ($CodigoRol) {
            case 1:
                // Digitador
                $where = new Expression('estado in (1,2,3,4,5,6,7,8,9,10,11,12,13)');
                return $where;
                break;
            case 2: // supervisor
                $where = new Expression('estado = 2 and Codigo_Rol in (1,3,6)');
                return $where;
                break;
            case 4: //  Director de mercadeo
                $where = new Expression('estado = 2 and Codigo_Rol in (1,15,16)');
                return $where;
                break;
            case 5: //Telemarketing
                $where = new Expression('estado in (1,2,3,4,5,6,7,8,9,10,11,12,13)');
                return $where;
                break;
            case 6: //Confirmador
                $where = new Expression('estado in (2,11)');
                return $where;
                break;
            case 10: //jefe de contratos
                $where = new Expression('estado = 10'); //Filtro de lista de usuarios
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
            case 17: // Director de Telemarketing
                $where = new Expression('Codigo_Rol in (5,7) and status = 1 and estado = 2');
                return $where;
                break;
            case 20:
                $where = new Expression('estado = 2');
                return $where;
        }
    }

    // Ayuda a filtrar la lista de clientes
    /**
     * @param $rol              Codigo Rol del Usuario
     * @return Expression
     *
     * case 4: Director de mercadeo estado a mostrar 1,15,16
     * case 5: Telemarketing estado mostrar 9
     */
    public function getSubFiltros($rol, $CodigoUsuario)
    {
        switch ($rol) {
            case 4: //  Director de mercadeo
                $where = new Expression('estado in (1,2,3,4,5,6,7,8,9,10,11,12,13)');
                return $where;
                break;
            case 5: // Telemarketing
                $where = new Expression('Codigo_Usuario = ' . $CodigoUsuario);
                return $where;
                break;
            case 10: //jefe de contratos
                $where = new Expression('estado = 11'); //Filtro de lista de usuarios
                return $where;
                break;
        }
    }

    public function getComisiones($rol, $id)
    {
        switch ($rol) {
            case 3: // anfitrion
                $where = new Expression('codigo_anfitrion = "' . $id . '"');
                return $where;
                break;
            case 8: // No access liner
                $where = new Expression('no_access_liner = "' . $id . '"');
                return $where;
                break;
            case 9: // No access closer
                $where = new Expression('no_access_closer = "' . $id . '"');
                return $where;
                break;
            case 15: // Supervisor anfitrion
                $where = new Expression('codigo_supervisor_anfitrion = "' . $id . '"');
                return $where;
                break;
            case 16: // Jefe anfitrion
                $where = new Expression('codigo_jefe_anfitrion = "' . $id . '"');
                return $where;
                break;
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
                            estado = '0',
                            email = ''
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

    public function InsertUsuario($codigo, $usuario, $email, $passEncryt, $Fecha_Crea, $usu_crea, $roles, $estado, $passDes, $status, $rol)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("
        INSERT INTO user (
        id, 
        username, 
        email, 
        password_hash, 
        auth_key, 
        status,
        Fecha_Creado, 
        Usuario_Creado, 
        Codigo_Rol, 
        pwdDes, 
        estado)
        VALUES (
        '" . $codigo . "',     
        '" . $usuario . "',
        '" . $email . "',
        '" . $passEncryt . "',
        '" . $roles . "',
        '" . $status . "',
        '" . $Fecha_Crea . "',
        '" . $usu_crea . "',
        '" . $rol . "',
        '" . $passDes . "',
        '" . $estado . "'
        );")->execute();
        $transaction->commit();

    }

    public function EmailValidador($email)
    {
        $query = new Query();
        $expresion = new Expression('id');
        $query->select($expresion)->from('user')->where('email = ' . "'$email'" . 'and estado = 1');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();

        if ($data == true) {
            return 1;
        } else
            return 0;

    }

    public function ActualizarPass($Codigo, $PassDes, $PassEncryt, $Fecha_Modi, $Usu_Modi, $Cod_Rol,$id_personal)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("UPDATE user SET 
                            password_hash = '" . $PassEncryt . "',
                            Usuario_Modificado = '" . $Usu_Modi . "',
                            Fecha_Modificada = '" . $Fecha_Modi . "',
                            pwdDes = '" . $PassDes . "',
                            Codigo_Rol = '" . $Cod_Rol . "',
                            id_personal = '" . $id_personal . "'
                            WHERE id = '" . $Codigo . "';")->execute();
        $transaction->commit();

    }

    public function ActualizarAsignacion($Codigo, $Cod_Rol)
    {
        $model = new Usuario();

        $asignacion = $model->getRol($Cod_Rol);

        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
//        $db->createCommand("UPDATE auth_assignment SET item_name = '" . $asignacion . "' WHERE user_id = '" . $Codigo . "'")->execute();
        $db->createCommand("INSERT INTO auth_assignment (item_name,user_id) values ('" . $asignacion . "','" . $Codigo . "')")->execute();
        $transaction->commit();
    }

    public function EliminarAsignacion($Codigo)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("DELETE FROM auth_assignment WHERE user_id = '" . $Codigo . "'")->execute();
        $transaction->commit();
    }
}


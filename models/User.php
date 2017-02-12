<?php

namespace app\models;

use Yii;

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
 *
 * @property AsigTlmkCliente[] $asigTlmkClientes
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
//            [['id', 'username', 'email', 'password_hash'], 'required'],
            [['id', 'confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'last_login_at', 'status', 'Codigo_Rol', 'estado'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificada', 'Fecha_Eliminada', 'Ultima_Sesion'], 'safe'],
            [['username', 'email', 'password_hash', 'unconfirmed_email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['password_reset_token'], 'string', 'max' => 256],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'pwdDes'], 'string', 'max' => 250],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_login_at' => 'Last Login At',
            'status' => 'Status',
            'password_reset_token' => 'Password Reset Token',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificada' => 'Fecha  Modificada',
            'Fecha_Eliminada' => 'Fecha  Eliminada',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Ultima_Sesion' => 'Ultima  Sesion',
            'Codigo_Rol' => 'Codigo  Rol',
            'pwdDes' => 'Pwd Des',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsigTlmkClientes()
    {
        return $this->hasMany(AsigTlmkCliente::className(), ['Codigo_telemarketing' => 'id']);
    }
}

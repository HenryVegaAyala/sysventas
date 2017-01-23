<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    const ROL_ANFITRION = 1;
    const ROL_SUPERVISOR = 2;
    const ROL_DIGITADOR = 3;
    const ROL_DIRECTOR_DE_MERCADEO = 4;
    const ROL_TELEMARKETING = 5;
    const ROL_CONFIRMADOR = 6;
    const ROL_SUPERVISORA_DE_TELEMARKETING = 7;
    const ROL_NO_ACCESS_LINER = 8;
    const ROL_NO_ACCESS_CLOSER = 9;
    const ROL_JEFE_DE_CONTRATOS = 10;
    const ROL_JEFE_DE_SALA = 11;
    const ROL_JEFE_DE_VENTAS = 12;
    const ROL_DIRECTOR_DE_PROYECTO = 13;
    const ROL_GERENTE_GENERAL = 14;

    public static function tableName()
    {
        return 'usuario';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->Codigo_Usuario;
    }

    public function getAuthKey()
    {
        return $this->AuthKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername($username)
    {

        $user = User::find()->where(['Email' => $username])->one();

        return $user;
    }

    public function validatePassword($password)
    {
        return $this->Contrasena === $password;
    }

    public function getCodigoRol()
    {
        return $this->hasOne(Rol::className(), ['Cod_Rol' => 'Codigo_Rol']);
    }

}

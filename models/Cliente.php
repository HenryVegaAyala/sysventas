<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $Codigo_Cliente
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Profesion
 * @property integer $Edad
 * @property string $Estado_Civil
 * @property string $Distrito
 * @property string $Direccion
 * @property string $Telefono_Casa
 * @property string $Telefono_Celular
 * @property string $Email
 * @property string $Traslado
 * @property integer $Tarjeta_De_Credito
 * @property string $Promotor
 * @property string $Local
 * @property string $Observacion
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 *
 * @property Factura[] $facturas
 */
class Cliente extends \yii\db\ActiveRecord
{
    public $uso_interno;

    public static function tableName()
    {
        return 'cliente';
    }

    public function rules()
    {
        return [
            [['Nombre', 'Apellido', 'Estado_Civil', 'Distrito', 'Profesion'], 'required'],
            [['Edad'], 'required', 'message' => 'Edad es requerida.'],
            [['Codigo_Cliente', 'Edad', 'Tarjeta_De_Credito'], 'integer', 'message' => 'Debe ser númerico.'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Nombre', 'Apellido', 'Distrito', 'Profesion', 'Local', 'Usuario_Creado'], 'string', 'max' => 100],
            [['Estado_Civil', 'Estado'], 'string', 'max' => 1],
            [['Direccion', 'Observacion'], 'string', 'max' => 200],
//            [['Telefono_Casa', 'Telefono_Celular'], 'integer', 'max' => 15],
            [['Promotor'], 'string', 'max' => 50],

            [['Nombre', 'Apellido', 'Distrito', 'Profesion'], 'match', 'pattern' => "/^.{3,80}$/", 'message' => 'Mínimo 3 caracteres'],
            [['Nombre', 'Apellido', 'Distrito', 'Profesion'], 'match', 'pattern' => "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\_\-\/\. ]+$/i", 'message' => 'Sólo se aceptan letras'],

            [['Telefono_Casa', 'Edad', 'Tarjeta_De_Credito', 'Telefono_Celular','Traslado'], 'integer', 'message' => 'Debe ser númerico.'],
            [['Telefono_Casa', 'Telefono_Celular'], 'match', 'pattern' => "/^.{3,15}$/",  'message' => 'Mínimo 7 caracteres del correo'],
            [['Edad'], 'match', 'pattern' => "/^.{2,2}$/",  'message' => 'Debe ser edad correcta'],

            [['Email'], 'match', 'pattern' => "/^.{3,45}$/",  'message' => 'Mínimo 3 caracteres del correo'],
            [['Email'], 'email', 'message' => 'Debe de ser un correo válido'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Cliente' => 'Codigo  Cliente',
            'Nombre' => 'Nombres',
            'Apellido' => 'Apellidos',
            'Profesion' => 'Profesión',
            'Edad' => 'Edad',
            'Estado_Civil' => 'Estado  Civil',
            'Distrito' => 'Distrito',
            'Direccion' => 'Dirección',
            'Telefono_Casa' => 'Teléfono de Casa',
            'Telefono_Celular' => 'Teléfono de Celular',
            'Email' => 'Correo Electrónico',
            'Traslado' => 'Traslado',
            'Tarjeta_De_Credito' => 'Tarjeta  De  Credito',
            'Promotor' => 'Promotor',
            'Local' => 'Local',
            'Observacion' => 'Observacion',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['Codigo_Cliente' => 'Codigo_Cliente']);
    }

    public function getDistrito()
    {
        $data = Distrito::find()
            ->select(['descripcion as value', 'descripcion as label'])
            ->asArray()
            ->all();
        return $data;
    }

    public function getCarrera()
    {
        $data = Carrera::find()
            ->select(['Nombre as value', 'Nombre as label'])
            ->asArray()
            ->all();
        return $data;
    }

    public function getEstadoCivil()
    {
        $var = [
            0 => 'Soltero/a',
            1 => 'Comprometido/a',
            2 => 'Casado/a',
            3 => 'Divorciado/a',
            4 => 'Viudo/a'
        ];
        return $var;
    }

    public function getTraslado()
    {
        $var = [
            0 => 'Particular',
            1 => 'Bus',
        ];
        return $var;
    }

    public function getTarjeta()
    {
        $var = [
            0 => 'Tarjeta de Crédito',
            1 => 'Tarjeta de Débito',
        ];
        return $var;
    }

    public function getCodigoCliente()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_Cliente), 0) + 1');
        $query->select($expresion)->from('cliente');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function ActualizarUsuario($id, $fh_delete,$usuario,$estado)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("UPDATE cliente SET 
                            Fecha_Eliminado = '" . $fh_delete . "',
                            Estado = '" . $estado . "',
                            Usuario_Eliminado = '" . $usuario . "'  
                            WHERE Codigo_Cliente = '" . $id . "';")->execute();
        $transaction->commit();

    }

}
<?php

namespace app\models;

use Yii;

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
    /**
     * @inheritdoc
     */
    public $uso_interno;

    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre', 'Apellido', 'Estado_Civil', 'Distrito', 'Profesion'], 'required'],
            [['Edad'], 'required', 'message' => 'Edad es requerida.'],
            [['Codigo_Cliente', 'Edad', 'Tarjeta_De_Credito'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'safe'],
            [['Nombre', 'Apellido', 'Local'], 'string', 'max' => 100],
            [['Profesion', 'Email', 'Traslado'], 'string', 'max' => 45],
            [['Estado_Civil', 'Estado'], 'string', 'max' => 1],
            [['Direccion', 'Observacion'], 'string', 'max' => 200],
            [['Telefono_Casa', 'Telefono_Celular'], 'string', 'max' => 15],
            [['Promotor'], 'string', 'max' => 50],
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
        $data = Usuario::find()
            ->select(['Email as value', 'Email as label'])
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

}

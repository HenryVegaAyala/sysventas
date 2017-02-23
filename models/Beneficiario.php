<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "beneficiario".
 *
 * @property integer $Codigo_Cliente
 * @property integer $Codigo_Beneficiario
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
 * @property Cliente $codigoCliente
 */
class Beneficiario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'beneficiario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['Codigo_Cliente', 'Codigo_Beneficiario'], 'required'],
            [['Codigo_Cliente', 'Codigo_Beneficiario', 'Edad', 'Tarjeta_De_Credito'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Nombre', 'Apellido', 'Distrito', 'Local', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Profesion', 'Email', 'Traslado'], 'string', 'max' => 45],
            [['Estado_Civil', 'Estado'], 'string', 'max' => 1],
            [['Direccion', 'Observacion'], 'string', 'max' => 200],
            [['Telefono_Casa', 'Telefono_Celular'], 'string', 'max' => 15],
            [['Promotor'], 'string', 'max' => 50],
            [['Codigo_Cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Codigo_Cliente' => 'Codigo_Cliente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Cliente' => 'Codigo  Cliente',
            'Codigo_Beneficiario' => 'Codigo  Beneficiario',
            'Nombre' => 'Nombre',
            'Apellido' => 'Apellido',
            'Profesion' => 'Profesion',
            'Edad' => 'Edad',
            'Estado_Civil' => 'Estado  Civil',
            'Distrito' => 'Distrito',
            'Direccion' => 'Direccion',
            'Telefono_Casa' => 'Telefono  Casa',
            'Telefono_Celular' => 'Telefono  Celular',
            'Email' => 'Email',
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
    public function getCodigoCliente()
    {
        return $this->hasOne(Cliente::className(), ['Codigo_Cliente' => 'Codigo_Cliente']);
    }

    public function getEstadoCivil()
    {
        $var = [
            0 => 'Esposo(a)',
            1 => 'Hijo(a)',
            2 => 'Padre',
            3 => 'Co-Titular',
        ];
        return $var;
    }
}

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
 * @property string $Direccion
 * @property string $Telefono
 * @property string $Observacion
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 * @property integer $Codigo_Opc
 * @property integer $Codigo_Tlmk
 *
 * @property Folio $codigoOpc
 * @property Folio $codigoTlmk
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['Codigo_Cliente', 'Codigo_Opc', 'Codigo_Tlmk'], 'required'],
            [['Codigo_Cliente', 'Codigo_Opc', 'Codigo_Tlmk'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'safe'],
            [['Nombre', 'Apellido'], 'string', 'max' => 100],
            [['Profesion'], 'string', 'max' => 45],
            [['Direccion', 'Observacion'], 'string', 'max' => 200],
            [['Telefono'], 'string', 'max' => 15],
            [['Estado'], 'string', 'max' => 1],
            [['Codigo_Opc'], 'exist', 'skipOnError' => true, 'targetClass' => Folio::className(), 'targetAttribute' => ['Codigo_Opc' => 'Codigo_Folio']],
            [['Codigo_Tlmk'], 'exist', 'skipOnError' => true, 'targetClass' => Folio::className(), 'targetAttribute' => ['Codigo_Tlmk' => 'Codigo_Folio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Cliente' => 'Codigo  Cliente',
            'Nombre' => 'Nombre',
            'Apellido' => 'Apellido',
            'Profesion' => 'Profesion',
            'Direccion' => 'Direccion',
            'Telefono' => 'Telefono',
            'Observacion' => 'Observacion',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Estado' => 'Estado',
            'Codigo_Opc' => 'Codigo  Opc',
            'Codigo_Tlmk' => 'Codigo  Tlmk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoOpc()
    {
        return $this->hasOne(Folio::className(), ['Codigo_Folio' => 'Codigo_Opc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoTlmk()
    {
        return $this->hasOne(Folio::className(), ['Codigo_Folio' => 'Codigo_Tlmk']);
    }
}

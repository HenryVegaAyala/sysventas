<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasaporte".
 *
 * @property integer $Codigo_pasaporte
 * @property string $Nombre
 * @property integer $Stock
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 *
 * @property Certificado[] $certificados
 * @property Venta[] $ventas
 */
class Pasaporte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pasaporte';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_pasaporte'], 'required'],
            [['Codigo_pasaporte', 'Stock'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Nombre', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_pasaporte' => 'Codigo Pasaporte',
            'Nombre' => 'Nombre',
            'Stock' => 'Stock',
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
    public function getCertificados()
    {
        return $this->hasMany(Certificado::className(), ['Codigo_pasaporte_afiliado' => 'Codigo_pasaporte']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::className(), ['Codigo_pasaporte' => 'Codigo_pasaporte']);
    }
}

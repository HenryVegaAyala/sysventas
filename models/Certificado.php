<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "certificado".
 *
 * @property integer $Codigo_certificado
 * @property integer $Codigo_venta
 * @property string $Codigo_pasaporte
 * @property string $Nombre
 * @property integer $Vigencia
 * @property string $Precio
 * @property integer $Stock
 * @property string $codigo_barra
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 *
 * @property Venta $codigoVenta
 */
class Certificado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'certificado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_venta', 'Vigencia', 'Stock'], 'integer'],
            [['Vigencia', 'Stock','Nombre'], 'required'],
            [['Precio'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Codigo_pasaporte', 'codigo_barra'], 'string', 'max' => 255],
            [['Nombre', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['Codigo_venta'], 'exist', 'skipOnError' => true, 'targetClass' => Venta::className(), 'targetAttribute' => ['Codigo_venta' => 'Codigo_venta']],

            [['codigo_barra'], 'match', 'pattern' => "/^.{9,9}$/", 'message' => 'Debe tener 9 digitos'],
            [['codigo_barra'], 'required', 'message' => 'El codigo pasaporte es requerido.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_certificado' => 'Codigo Certificado',
            'Codigo_venta' => 'Codigo Venta',
            'Codigo_pasaporte' => 'Codigo Pasaporte',
            'Nombre' => 'Nombre',
            'Vigencia' => 'Vigencia',
            'Precio' => 'Precio',
            'Stock' => 'Stock',
            'codigo_barra' => 'Ingresar Codigo Certificado',
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
    public function getCodigoVenta()
    {
        return $this->hasOne(Venta::className(), ['Codigo_venta' => 'Codigo_venta']);
    }
}
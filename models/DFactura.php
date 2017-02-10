<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "d_factura".
 *
 * @property integer $id
 * @property integer $factura
 * @property string $Descripcion
 * @property string $precio
 * @property integer $Cantidad
 * @property string $igv
 * @property string $Subtotal
 * @property string $Total
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 * @property integer $Pasaporte
 *
 * @property Factura $factura0
 */
class DFactura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_factura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['factura'], 'required'],
            [['factura', 'Cantidad', 'Pasaporte'], 'integer'],
            [['precio', 'igv', 'Subtotal', 'Total'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Descripcion'], 'string', 'max' => 85],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['factura'], 'exist', 'skipOnError' => true, 'targetClass' => Factura::className(), 'targetAttribute' => ['factura' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'factura' => 'Factura',
            'Descripcion' => 'Descripcion',
            'precio' => 'Precio',
            'Cantidad' => 'Cantidad',
            'igv' => 'Igv',
            'Subtotal' => 'Subtotal',
            'Total' => 'Total',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Estado' => 'Estado',
            'Pasaporte' => 'Pasaporte',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactura0()
    {
        return $this->hasOne(Factura::className(), ['id' => 'factura']);
    }
}

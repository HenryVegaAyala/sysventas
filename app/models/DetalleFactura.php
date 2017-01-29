<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalle_factura".
 *
 * @property integer $Codigo_Factura
 * @property integer $Codigo_Fact_Detalle
 * @property string $Descripcion
 * @property string $precio
 * @property integer $igv
 * @property string $Subtotal
 * @property string $Total
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 * @property integer $Cantidad
 *
 * @property Combo[] $combos
 * @property Factura $codigoFactura
 * @property Producto[] $productos
 */
class DetalleFactura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detalle_factura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_Factura', 'Codigo_Fact_Detalle'], 'required'],
            [['Codigo_Factura', 'Codigo_Fact_Detalle', 'igv', 'Cantidad'], 'integer'],
            [['precio', 'Subtotal', 'Total'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'safe'],
            [['Descripcion'], 'string', 'max' => 85],
            [['Estado'], 'string', 'max' => 1],
            [['Codigo_Factura'], 'exist', 'skipOnError' => true, 'targetClass' => Factura::className(), 'targetAttribute' => ['Codigo_Factura' => 'Codigo_Factura']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Factura' => 'Codigo  Factura',
            'Codigo_Fact_Detalle' => 'Codigo  Fact  Detalle',
            'Descripcion' => 'Descripcion',
            'precio' => 'Precio',
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
            'Cantidad' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCombos()
    {
        return $this->hasMany(Combo::className(), ['Codigo_Fact_Detalle' => 'Codigo_Fact_Detalle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoFactura()
    {
        return $this->hasOne(Factura::className(), ['Codigo_Factura' => 'Codigo_Factura']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['Codigo_Fact_Detalle' => 'Codigo_Fact_Detalle']);
    }
}

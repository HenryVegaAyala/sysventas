<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;
/**
 * This is the model class for table "d_factura".
 *
 * @property integer $id
 * @property integer $factura
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
            [['id', 'factura'], 'required'],
            [['id', 'factura', 'igv', 'Cantidad'], 'integer'],
            [['precio', 'Subtotal', 'Total'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'safe'],
            [['Descripcion'], 'string', 'max' => 85],
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
    public function getFactura0()
    {
        return $this->hasOne(Factura::className(), ['id' => 'factura']);
    }

    public function getCodigoDetFactura()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(id), 0) + 1');
        $query->select($expresion)->from('d_factura');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }
}

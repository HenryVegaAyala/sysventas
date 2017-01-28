<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property integer $Codigo_Producto
 * @property string $Nombre
 * @property string $Precio
 * @property string $Precio_por_Noche
 * @property integer $Vigencia
 * @property double $Desc_Afiliado
 * @property string $Combo_Adquirido
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 *
 * @property DetalleFactura[] $detalleFacturas
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre', 'Precio', 'Precio_por_Noche', 'Vigencia', 'Desc_Afiliado'], 'required'],
            [['Codigo_Producto', 'Vigencia'], 'integer'],
            [['Precio', 'Precio_por_Noche', 'Desc_Afiliado'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'safe'],
            [['Nombre'], 'string', 'max' => 100],
            [['Combo_Adquirido'], 'string', 'max' => 120],
            [['Estado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Producto' => 'Codigo  Producto',
            'Nombre' => 'Nombre',
            'Precio' => 'Precio',
            'Precio_por_Noche' => 'Precio por  Noche',
            'Vigencia' => 'Vigencia',
            'Desc_Afiliado' => 'Descuento para  Afiliados',
            'Combo_Adquirido' => 'Combo  Adquirido',
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
    public function getDetalleFacturas()
    {
        return $this->hasMany(DetalleFactura::className(), ['Codigo_Producto' => 'Codigo_Producto']);
    }
}

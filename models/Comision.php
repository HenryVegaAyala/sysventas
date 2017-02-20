<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comision".
 *
 * @property integer $Codigo
 * @property integer $Codigo_venta
 * @property string $Codigo_usuario
 * @property string $monto
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Estado
 *
 * @property Venta $codigoVenta
 */
class Comision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comision';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_venta'], 'required'],
            [['Codigo_venta'], 'integer'],
            [['monto'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado'], 'safe'],
            [['Codigo_usuario'], 'string', 'max' => 255],
            [['Usuario_Creado', 'Usuario_Modificado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['Codigo_venta'], 'exist', 'skipOnError' => true, 'targetClass' => Venta::className(), 'targetAttribute' => ['Codigo_venta' => 'Codigo_venta']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo' => 'Codigo',
            'Codigo_venta' => 'Codigo Venta',
            'Codigo_usuario' => 'Codigo Usuario',
            'monto' => 'Monto',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
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

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "formas_pago".
 *
 * @property integer $Codigo_TipoPago
 * @property integer $codigo_pago
 * @property string $fecha_pago
 * @property string $monto
 * @property string $comprobante
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Eliminado
 * @property string $Usuario_Modificado
 * @property string $Estado
 * @property string $restante
 *
 * @property Pago $codigoPago
 */
class FormasPago extends \yii\db\ActiveRecord
{
    public $restante;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'formas_pago';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_pago'], 'required'],
            [['codigo_pago','restante'], 'integer'],
            [['fecha_pago', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['monto'], 'number'],
            [['Fecha_Creado'], 'string', 'max' => 45],
            [['comprobante'], 'string', 'max' => 30],
            [['Usuario_Creado', 'Usuario_Eliminado', 'Usuario_Modificado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['codigo_pago'], 'exist', 'skipOnError' => true, 'targetClass' => Pago::className(), 'targetAttribute' => ['codigo_pago' => 'codigo_pago']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_TipoPago' => 'Codigo  Tipo Pago',
            'codigo_pago' => 'Codigo Pago',
            'fecha_pago' => 'Fecha Pago',
            'monto' => 'Monto',
            'comprobante' => 'N° de Comprobante',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Estado' => 'Estado',
            'restante' => 'Restante',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoPago()
    {
        return $this->hasOne(Pago::className(), ['codigo_pago' => 'codigo_pago']);
    }
}

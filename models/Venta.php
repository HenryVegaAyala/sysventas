<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "venta".
 *
 * @property integer $Codigo_venta
 * @property integer $Codigo_pasaporte
 * @property integer $Codigo_Cliente
 * @property string $medio_pago
 * @property string $Estado_pago
 * @property double $porcentaje_pagado
 * @property string $cod_barra_pasaporte
 * @property string $cod_barra_pasaporte_manual
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 *
 * @property Cliente $codigoCliente
 * @property Pasaporte $codigoPasaporte
 */
class Venta extends \yii\db\ActiveRecord
{

    public $uso_interno;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'venta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_venta', 'Codigo_pasaporte', 'Codigo_Cliente', 'medio_pago', 'Estado_pago'], 'required'],
            [['Codigo_venta'], 'integer'],
            [['porcentaje_pagado'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['medio_pago', 'Estado_pago', 'Estado'], 'string', 'max' => 1],
            [['cod_barra_pasaporte', 'cod_barra_pasaporte_manual'], 'string', 'max' => 45],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Codigo_Cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Codigo_Cliente' => 'Codigo_Cliente']],
            [['Codigo_pasaporte'], 'exist', 'skipOnError' => true, 'targetClass' => Pasaporte::className(), 'targetAttribute' => ['Codigo_pasaporte' => 'Codigo_pasaporte']],

            [['Codigo_Cliente', 'Codigo_pasaporte'], 'match', 'pattern' => "/^.{3,80}$/", 'message' => 'Mínimo 3 caracteres'],
            [['Codigo_Cliente', 'Codigo_pasaporte'], 'match', 'pattern' => "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\_\-\/\. ]+$/i", 'message' => 'Sólo se aceptan letras'],

            [['porcentaje_pagado'], 'integer', 'message' => 'Debe ser númerico.'],
            [['porcentaje_pagado', 'cod_barra_pasaporte'], 'match', 'pattern' => "/^.{1,15}$/", 'message' => 'Mínimo 1 caracteres'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_venta' => 'Codigo Venta',
            'Codigo_pasaporte' => 'Pasaporte',
            'Codigo_Cliente' => 'Datos del Cliente',
            'medio_pago' => 'Medio de Pago',
            'Estado_pago' => 'Estado Pago',
            'porcentaje_pagado' => 'Porcentaje Pagado',
            'cod_barra_pasaporte' => 'Codigo de Barra',
            'cod_barra_pasaporte_manual' => 'Codigo de Barra Manual',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Estado' => 'Estado',
            'uso_interno' => 'Seleccionar si no tiene codigo de barras',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoCliente()
    {
        return $this->hasOne(Cliente::className(), ['Codigo_Cliente' => 'Codigo_Cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoPasaporte()
    {
        return $this->hasOne(Pasaporte::className(), ['Codigo_pasaporte' => 'Codigo_pasaporte']);
    }

    public function getCodigo()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_venta), 0) + 1');
        $query->select($expresion)->from('venta');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getCliente()
    {
        $data = Cliente::find()
            ->select(["concat(Nombre ,' ', Apellido) as value", "concat(Nombre ,' ', Apellido) as label"])
            ->where('estado = 10')
            ->asArray()
            ->all();
        return $data;
    }

    public function getPasaporte()
    {
        $data = Pasaporte::find()
            ->select(["Nombre as value", "Nombre as label"])
//            ->where('estado = 1')
            ->asArray()
            ->all();
        return $data;
    }

    public function getMedioDePago()
    {
        $var = [
            0 => 'Tarjeta de Credito',
            1 => 'Tarjeta de Debito',
            2 => 'Efectivo',
        ];
        return $var;
    }

    public function getEstadoDePago()
    {
        $var = [
            0 => 'Adelanto',
            1 => 'Anulado',
            2 => 'Cancelado',
        ];
        return $var;
    }
    
}

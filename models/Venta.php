<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

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
            [['Codigo_venta', 'Codigo_pasaporte', 'Codigo_Cliente'], 'required'],
            [['Codigo_venta', 'Codigo_pasaporte', 'Codigo_Cliente'], 'integer'],
            [['porcentaje_pagado'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['medio_pago', 'Estado_pago', 'Estado'], 'string', 'max' => 1],
            [['cod_barra_pasaporte', 'cod_barra_pasaporte_manual'], 'string', 'max' => 45],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Codigo_Cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Codigo_Cliente' => 'Codigo_Cliente']],
            [['Codigo_pasaporte'], 'exist', 'skipOnError' => true, 'targetClass' => Pasaporte::className(), 'targetAttribute' => ['Codigo_pasaporte' => 'Codigo_pasaporte']],
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
            'Codigo_Cliente' => 'Cliente',
            'medio_pago' => 'Medio Pago',
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
}

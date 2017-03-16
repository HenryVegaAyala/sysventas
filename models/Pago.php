<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "pago".
 *
 * @property integer $Codigo_venta
 * @property integer $codigo_pago
 * @property integer $tipo_pago
 * @property integer $estado_pago
 * @property string $monto_pagado
 * @property string $monto_ingresado
 * @property string $monto_restante
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Eliminado
 * @property string $Usuario_Modificado
 * @property string $Estado
 * @property string $comentario
 *
 * @property FormasPago[] $formasPagos
 * @property Venta $codigoVenta
 */
class Pago extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pago';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_venta', 'codigo_pago'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['monto_pagado', 'monto_ingresado', 'monto_restante', 'tipo_pago', 'estado_pago','comentario'], 'string', 'max' => 255],
            [['Usuario_Creado', 'Usuario_Eliminado', 'Usuario_Modificado'], 'string', 'max' => 100],
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
            'Codigo_venta' => 'Codigo Venta',
            'codigo_pago' => 'Codigo Pago',
            'tipo_pago' => 'Tipo Pago',
            'estado_pago' => 'Estado Pago',
            'monto_pagado' => 'Monto Pagado',
            'monto_ingresado' => 'Monto Ingresado',
            'monto_restante' => 'Monto Restante',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Estado' => 'Estado',
            'comentario' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormasPagos()
    {
        return $this->hasMany(FormasPago::className(), ['codigo_pago' => 'codigo_pago']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoVenta()
    {
        return $this->hasOne(Venta::className(), ['Codigo_venta' => 'Codigo_venta']);
    }

    public function getCodigo()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(codigo_pago), 0) + 1');
        $query->select($expresion)->from('pago');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getMedioDePago($codigo)
    {
        switch ($codigo){
            case 0:
                return "Tarjeta de Credito";
                break;
            case 1:
                return "Tarjeta de Debito";
                break;
            case 2:
                return "Plazo";
                break;
            case 3:
                return "Letras";
                break;
            case 4:
                return "Cash";
                break;
        }
    }

    public function getEstadoDePago($codigo)
    {

        switch ($codigo){
            case 0:
                return "Adelanto";
                break;
            case 1:
                return "Pendiente";
                break;
            case 2:
                return "Cancelado";
                break;
        }
    }

    public function CodigoPago($Codigo)
    {
        $query = new Query();
        $select = new Expression('codigo_pago');
        $where = new Expression("Codigo_venta = " . "'$Codigo'");
        $query->select($select)->from('pago')->where($where);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }
}

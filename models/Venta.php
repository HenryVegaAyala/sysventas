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
 * @property integer $Codigo_club
 * @property integer $Codigo_Cliente
 * @property integer $medio_pago
 * @property integer $Estado_pago
 * @property integer $porcentaje_pagado
 * @property string $cod_barra_pasaporte
 * @property string $cod_barra_pasaporte_manual
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property integer $Estado
 * @property integer $Factura_emitida
 * @property integer $Codigo_pasaporte
 *
 * @property Contrato[] $contratos
 * @property Documento[] $documentos
 * @property Cliente $codigoCliente
 * @property Club $codigoClub
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
            [['Codigo_venta', 'Codigo_club', 'Codigo_Cliente', 'medio_pago', 'Estado_pago', 'porcentaje_pagado', 'Codigo_pasaporte'], 'required'],
            [['Codigo_venta', 'Codigo_club', 'Codigo_pasaporte'], 'integer'],
            [['porcentaje_pagado'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['medio_pago', 'Estado_pago', 'Estado', 'Factura_emitida'], 'string', 'max' => 1],
            [['cod_barra_pasaporte', 'cod_barra_pasaporte_manual'], 'string', 'max' => 45],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Codigo_Cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Codigo_Cliente' => 'Codigo_Cliente']],
            [['Codigo_club'], 'exist', 'skipOnError' => true, 'targetClass' => Club::className(), 'targetAttribute' => ['Codigo_club' => 'Codigo_club']],

            [['Codigo_Cliente'], 'match', 'pattern' => "/^.{3,80}$/", 'message' => 'Mínimo 3 caracteres'],
            [['Codigo_Cliente'], 'match', 'pattern' => "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\_\-\/\. ]+$/i", 'message' => 'Sólo se aceptan letras'],

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
            'Codigo_club' => 'Tipo de Club',
            'Codigo_Cliente' => 'Datos del Cliente',
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
            'Factura_emitida' => 'Factura Emitida',
            'Codigo_pasaporte' => 'Pasaporte',
            'uso_interno' => 'Seleccionar si no tiene codigo de barras',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contrato::className(), ['Codigo_venta' => 'Codigo_venta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['Codigo_venta' => 'Codigo_venta']);
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
    public function getCodigoClub()
    {
        return $this->hasOne(Club::className(), ['Codigo_club' => 'Codigo_club']);
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
        $resultado = ArrayHelper::map(
            Pasaporte::find()
                ->select(['Codigo_pasaporte' => 'Codigo_pasaporte', 'Nombre' => "Nombre"])
                ->asArray()
                ->all(), 'Codigo_pasaporte', 'Nombre');
        return $resultado;
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

    public function MedioDePago($codigo)
    {
        switch ($codigo) {
            case 0:
                return 'Tarjeta de Credito';
                break;
            case 1:
                return 'Tarjeta de Debito';
                break;
            case 2:
                return 'Efectivo';
                break;
        }
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

    public function EstadoDePago($codigo)
    {
        switch ($codigo) {
            case 0:
                return 'Adelanto';
                break;
            case 1:
                return 'Anulado';
                break;
            case 2:
                return 'Cancelado';
                break;
        }
    }

    public function getClub()
    {
        $resultado = ArrayHelper::map(
            Club::find()
                ->select(['Codigo_Club' => 'Codigo_Club', 'Nombre' => "Nombre"])
                ->asArray()
                ->all(), 'Codigo_Club', 'Nombre');
        return $resultado;
    }

    public function CodigoCliente($nombre)
    {
        $query = new Query();
        $codigo = new Expression('Codigo_Cliente');
        $where = new Expression("trim(concat(Nombre,' ',Apellido)) = " . "'$nombre'");
        $query->select($codigo)->from('cliente')->where($where);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function InsertVenta($CodVen, $Est, $CodCli, $MedP, $EstPag, $PorPag, $CodClu, $CodPas)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand()
            ->insert('venta', [
                'Codigo_venta' => $CodVen,
                'Estado' => $Est,
                'Codigo_Cliente' => $CodCli,
                'medio_pago' => $MedP,
                'Estado_pago' => $EstPag,
                'porcentaje_pagado' => $PorPag,
                'Codigo_club' => $CodClu,
                'Codigo_pasaporte' => $CodPas])
            ->execute();
        $transaction->commit();
    }

    public function Club($codigo)
    {
        $query = new Query();
        $query->select('Nombre')->from('Club')->where("Codigo_Club ='" . $codigo . "'");
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function Pasaporte($codigo)
    {
        $query = new Query();
        $query->select('Nombre')->from('Pasaporte')->where("Codigo_pasaporte ='" . $codigo . "'");
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }
}
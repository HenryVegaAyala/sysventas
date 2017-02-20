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
 * @property integer $Codigo_pasaporte
 * @property integer $Codigo_Cliente
 * @property string $numero_contrato
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property integer $Estado
 * @property string $numero_comprobante
 * @property string $serie_comprobante
 * @property integer $salas
 *
 *
 * @property string $uso_interno
 * @property string $numero_pasaporte
 * @property integer $numero_escaneado
 * @property integer $numero_total
 * @property double $montoTotal
 * @property integer $restante
 *
 * @property string $codigo_comision1;
 * @property string $codigo_comision2;
 * @property string $codigo_comision3;
 * @property string $codigo_comision4;
 * @property string $codigo_comision5;
 * @property string $codigo_comision6;
 * @property string $codigo_comision7;
 * @property string $codigo_comision8;
 * @property string $codigo_comision9;
 * @property string $codigo_comision10;
 * @property string $codigo_comision11;
 * @property string $codigo_comision12;
 * @property string $codigo_comision13;
 * @property string $Codigo_venta_Comision;
 * @property string $CodigoComision;
 *
 * @property Certificado[] $certificados
 * @property Combo[] $combos
 * @property Comision[] $comisions
 * @property Documento[] $documentos
 * @property Pago[] $pagos
 * @property Cliente $codigoCliente
 * @property Club $codigoClub
 * @property Pasaporte $codigoPasaporte
 */
class Venta extends \yii\db\ActiveRecord
{
    public $uso_interno;
    public $numero_escaneado;
    public $numero_total;
    public $montoTotal;
    public $restante;

    public $CodigoComision;
    public $Codigo_venta_Comision;
    public $codigo_comision1;
    public $codigo_comision2;
    public $codigo_comision3;
    public $codigo_comision4;
    public $codigo_comision5;
    public $codigo_comision6;
    public $codigo_comision7;
    public $codigo_comision8;
    public $codigo_comision9;
    public $codigo_comision10;
    public $codigo_comision11;
    public $codigo_comision12;
    public $codigo_comision13;

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
            [['Codigo_club', 'Codigo_pasaporte', 'Codigo_Cliente','uso_interno'], 'required'],
            [['Codigo_club', 'Codigo_pasaporte', 'Codigo_Cliente', 'Estado'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['numero_contrato', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Codigo_Cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Codigo_Cliente' => 'Codigo_Cliente']],
            [['Codigo_club'], 'exist', 'skipOnError' => true, 'targetClass' => Club::className(), 'targetAttribute' => ['Codigo_club' => 'Codigo_club']],
            [['Codigo_pasaporte'], 'exist', 'skipOnError' => true, 'targetClass' => Pasaporte::className(), 'targetAttribute' => ['Codigo_pasaporte' => 'Codigo_pasaporte']],

            [['serie_comprobante'], 'string'],
            [['numero_comprobante'], 'string'],
            [['salas'], 'string'],

            [['numero_contrato'], 'required', 'message' => 'N° de Contrato es necesario.'],
            [['serie_comprobante'], 'required', 'message' => 'Se requiere la Serie.'],
            [['numero_comprobante'], 'required', 'message' => 'Se requiere N° de Comprobante.'],
            [['salas'], 'required', 'message' => 'Se requiere seleccionar una sala.'],

            [['uso_interno'], 'string'],
            [['numero_pasaporte'], 'match', 'pattern' => "/^.{9,9}$/", 'message' => 'Debe tener 9 digitos'],
            [['numero_pasaporte'], 'required', 'message' => 'El codigo pasaporte es requerido.'],
            [['numero_escaneado', 'numero_total', 'montoTotal', 'restante'], 'double'],
            [['Codigo_venta_Comision','CodigoComision','codigo_comision1', 'codigo_comision2', 'codigo_comision3', 'codigo_comision4', 'codigo_comision5', 'codigo_comision6','codigo_comision7', 'codigo_comision8', 'codigo_comision9', 'codigo_comision10', 'codigo_comision11', 'codigo_comision12', 'codigo_comision13'], 'string'],
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
            'Codigo_pasaporte' => 'Tipo de Pasaporte',
            'Codigo_Cliente' => 'Codigo  Cliente',
            'numero_contrato' => 'Numero Contrato',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Estado' => 'Estado',
            'numero_pasaporte' => 'Ingresar Código de Pasaporte',
            'numero_escaneado' => 'Escaneados',
            'numero_total' => 'Total Noches',
            'uso_interno' => 'Buscar Clientes',
            'serie_comprobante' => 'Serie del Comprobante',
            'numero_comprobante' => 'Número del Comprobante',

            'codigo_comision1' => 'Digitador',
            'codigo_comision2' => 'OPC',
            'codigo_comision3' => 'Supervisor Promotor',
            'codigo_comision4' => 'Supervior General OPC',
            'codigo_comision5' => 'Director de Mercadero',
            'codigo_comision6' => 'TLMK',
            'codigo_comision7' => 'Confirmadora',
            'codigo_comision8' => 'Director de TLMK',
            'codigo_comision9' => 'Liner',
            'codigo_comision10' => 'Closer',
            'codigo_comision11' => 'Jefe de Sala',
            'codigo_comision12' => 'Director de Ventas',
            'codigo_comision13' => 'Director de Proyectos',



        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificado::className(), ['Codigo_venta' => 'Codigo_venta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCombos()
    {
        return $this->hasMany(Combo::className(), ['Codigo_venta' => 'Codigo_venta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComisions()
    {
        return $this->hasMany(Comision::className(), ['Codigo_venta' => 'Codigo_venta']);
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
    public function getPagos()
    {
        return $this->hasMany(Pago::className(), ['Codigo_venta' => 'Codigo_venta']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoPasaporte()
    {
        return $this->hasOne(Pasaporte::className(), ['Codigo_pasaporte' => 'Codigo_pasaporte']);
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

    public function getCliente()
    {
        $data = Cliente::find()
            ->select(["concat(Nombre ,' ', Apellido) as value", "concat(Nombre ,' ', Apellido) as label"])
            ->where('estado in (1,2,3,4,5,6,7,8,9,10,11,12,13)')
            ->asArray()
            ->all();
        return $data;
    }

    public function getCodigoCertificado()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_certificado), 0) + 1');
        $query->select($expresion)->from('certificado');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getCodigoPago()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(codigo_pago), 0) + 1');
        $query->select($expresion)->from('pago');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getCodigoFormaPago()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_TipoPago), 0) + 1');
        $query->select($expresion)->from('formas_pago');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getCodigoVenta()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_venta), 0) + 1');
        $query->select($expresion)->from('venta');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getCodigoCombo()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_Combo), 0) + 1');
        $query->select($expresion)->from('combo');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getCodigoComision()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(codigo), 0) + 1');
        $query->select($expresion)->from('comision');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getMedioDePago()
    {
        $var = [
            0 => 'Tarjeta de Credito',
            1 => 'Tarjeta de Debito',
            2 => 'Plazo',
            3 => 'Letras',
            4 => 'Cash',
        ];
        return $var;
    }

    public function getEstadoDePago()
    {
        $var = [
            0 => 'Adelanto',
            1 => 'Pendiente',
            2 => 'Cancelado',
        ];
        return $var;
    }

    public function getSalas()
    {
        $var = [
            0 => 'Pachacamac',
            1 => 'Costa Verde',
            2 => 'Vichayito.',
        ];
        return $var;
    }

    public function Club($codigo)
    {
        $query = new Query();
        $query->select('Nombre')->from('club')->where("Codigo_Club ='" . $codigo . "'");
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

}
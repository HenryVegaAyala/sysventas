<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "factura".
 *
 * @property integer $id
 * @property integer $Codigo_Cliente
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 * @property integer $Codigo_Combo
 * @property string $direccion
 *
 * @property DFactura[] $dFacturas
 * @property Cliente $codigoCliente
 * @property Producto $codigoCombo
 */
class Factura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'factura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_Cliente', 'Codigo_Combo'], 'required'],
            [['id', 'Codigo_Combo'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado','direccion'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['Codigo_Cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Codigo_Cliente' => 'Codigo_Cliente']],
            [['Codigo_Combo'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['Codigo_Combo' => 'Codigo_Producto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Número correlativo ',
            'Codigo_Cliente' => 'Cliente',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Estado' => 'Estado',
            'Codigo_Combo' => 'Pasaporte',
            'direccion' => 'direccion'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDFacturas()
    {
        return $this->hasMany(DFactura::className(), ['factura' => 'id']);
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
    public function getCodigoCombo()
    {
        return $this->hasOne(Producto::className(), ['Codigo_Producto' => 'Codigo_Combo']);
    }

    public function getCodigoFactura()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Valor), 0) + 1');
        $query->select($expresion)->from('folio')->where('Codigo_Folio = 3');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getPasaporte()
    {
        $resultado = ArrayHelper::map(
            Producto::find()
                ->orderBy('Nombre asc')
                ->where('estado = 1')->asArray()
                ->all(), 'Codigo_Producto', 'Nombre');
        return $resultado;
    }

    public function getCliente()
    {
        $data = Cliente::find()
            ->select(["concat(Nombre ,' ', Apellido) as value", "concat(Nombre ,' ', Apellido) as label"])
            ->where('estado = 1')
            ->asArray()
            ->all();
        return $data;
    }

    public function Cliente($nombre)
    {
        $query = new Query();
        $query->select('Codigo_Cliente')->from('cliente')->where("concat(Nombre,' ',Apellido) ='" . $nombre . "'");
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function SP_Factura_AI()
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand('call Actualizar_Folio_Factura()');
        $command->execute();
    }

    public function SP_Factura($codigo)
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand("call Factura('".$codigo."')");
        $command->execute();
    }

    public function SP_Delete($codigo)
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand("call Delete_Factura('".$codigo."')");
        $command->execute();
    }

    public function NombreCliente($codigo)
    {
        $query = new Query();
        $expresion = new Expression("concat(Nombre,' ',Apellido)");
        $query->select($expresion)->from('cliente')->where("Codigo_Cliente ='" . $codigo . "'");
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }
}
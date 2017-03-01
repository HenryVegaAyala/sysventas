<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "club".
 *
 * @property integer $Codigo_club
 * @property string $Nombre
 * @property string $Precio
 * @property string $Precio_por_Noche
 * @property integer $Vigencia
 * @property double $Desc_Afiliado
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 * @property string $Dias_noches
 *
 * @property Venta[] $ventas
 */
class Club extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'club';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre','Precio','Precio_por_Noche'], 'required'],
            [['Codigo_club', 'Vigencia'], 'integer'],
            [['Precio', 'Precio_por_Noche', 'Desc_Afiliado'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Nombre', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['Dias_noches'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_club' => 'Codigo Club',
            'Nombre' => 'Nombre',
            'Precio' => 'Precio',
            'Precio_por_Noche' => 'Precio Por Noche',
            'Vigencia' => 'Vigencia Anual',
            'Desc_Afiliado' => 'Descuento Afiliado',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Estado' => 'Estado',
            'Dias_noches' => 'Cantidad de Noches',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::className(), ['Codigo_club' => 'Codigo_club']);
    }

    public function getCodigo()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_club), 0) + 1');
        $query->select($expresion)->from('club');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getDiasNoche($codigo)
    {
        $query = new Query();
        $expresion = new Expression('Dias_noches');
        $where = new Expression('Codigo_Club = "'.$codigo.'"');
        $query->select($expresion)->from('club')->where($where);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function PrecioClub($codigo)
    {
        $query = new Query();
        $query->select('Precio')->from('club')->where("Codigo_club ='" . $codigo . "'");
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }
}
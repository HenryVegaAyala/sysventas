<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "combo".
 *
 * @property integer $Codigo_Combo
 * @property integer $Codigo_venta
 * @property string $convetidor1
 * @property string $convetidor2
 * @property string $Observacion
 * @property string $Regalos
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 *
 * @property Venta $codigoVenta
 */
class Combo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'combo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_venta'], 'required'],
            [['Codigo_venta'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['convetidor1'], 'string', 'max' => 250],
            [['convetidor2', 'Observacion', 'Regalos'], 'string', 'max' => 255],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 200],
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
            'Codigo_Combo' => 'Codigo  Combo',
            'Codigo_venta' => 'Codigo Venta',
            'convetidor1' => 'Convetidor1',
            'convetidor2' => 'Convetidor2',
            'Observacion' => 'Observacion',
            'Regalos' => 'Regalos',
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
    public function getCodigoVenta()
    {
        return $this->hasOne(Venta::className(), ['Codigo_venta' => 'Codigo_venta']);
    }

    public function getCodigoCombo($id)
    {
        $query = new Query();
        $select = new Expression('Codigo_combo');
        $where = new Expression('Codigo_venta  = "'.$id.'"');
        $query->select($select)->from('combo')->where($where);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }
}

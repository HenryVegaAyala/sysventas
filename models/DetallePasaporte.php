<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalle_pasaporte".
 *
 * @property integer $Codigo_pasaporte
 * @property integer $codigo_detpasaporte
 * @property string $codigo_barra
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 *
 * @property Pasaporte $codigoPasaporte
 */
class DetallePasaporte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detalle_pasaporte';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_pasaporte'], 'required'],
            [['Codigo_pasaporte'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['codigo_barra'], 'string', 'max' => 255],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['Codigo_pasaporte'], 'exist', 'skipOnError' => true, 'targetClass' => Pasaporte::className(), 'targetAttribute' => ['Codigo_pasaporte' => 'Codigo_pasaporte']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_pasaporte' => 'Codigo Pasaporte',
            'codigo_detpasaporte' => 'Codigo Detpasaporte',
            'codigo_barra' => 'Codigo Barra',
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
    public function getCodigoPasaporte()
    {
        return $this->hasOne(Pasaporte::className(), ['Codigo_pasaporte' => 'Codigo_pasaporte']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "certificado".
 *
 * @property integer $Codigo_certificado
 * @property string $Nombre
 * @property integer $Vigencia
 * @property string $Precio
 * @property integer $Stock
 * @property integer $Codigo_pasaporte_afiliado
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 *
 * @property Pasaporte $codigoPasaporteAfiliado
 * @property Club[] $clubs
 */
class Certificado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'certificado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre'], 'required'],
            [['Codigo_certificado', 'Vigencia', 'Stock', 'Codigo_pasaporte_afiliado'], 'integer'],
            [['Precio'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Nombre', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['Codigo_pasaporte_afiliado'], 'exist', 'skipOnError' => true, 'targetClass' => Pasaporte::className(), 'targetAttribute' => ['Codigo_pasaporte_afiliado' => 'Codigo_pasaporte']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_certificado' => 'Codigo Certificado',
            'Nombre' => 'Nombre',
            'Vigencia' => 'Vigencia',
            'Precio' => 'Precio',
            'Stock' => 'Stock',
            'Codigo_pasaporte_afiliado' => 'Codigo Pasaporte Afiliado',
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
    public function getCodigoPasaporteAfiliado()
    {
        return $this->hasOne(Pasaporte::className(), ['Codigo_pasaporte' => 'Codigo_pasaporte_afiliado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClubs()
    {
        return $this->hasMany(Club::className(), ['Codigo_certificado' => 'Codigo_certificado']);
    }
}

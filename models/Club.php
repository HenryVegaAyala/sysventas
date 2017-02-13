<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "club".
 *
 * @property integer $Codigo_club
 * @property string $Nombre
 * @property string $Precio
 * @property string $Precio_por_Noche
 * @property integer $Vigencia
 * @property double $Desc_Afiliado
 * @property integer $Codigo_certificado
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 *
 * @property Certificado $codigoCertificado
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
            [['Codigo_club'], 'required'],
            [['Codigo_club', 'Vigencia', 'Codigo_certificado'], 'integer'],
            [['Precio', 'Precio_por_Noche', 'Desc_Afiliado'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Nombre', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['Codigo_certificado'], 'exist', 'skipOnError' => true, 'targetClass' => Certificado::className(), 'targetAttribute' => ['Codigo_certificado' => 'Codigo_certificado']],
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
            'Precio_por_Noche' => 'Precio Por  Noche',
            'Vigencia' => 'Vigencia',
            'Desc_Afiliado' => 'Desc  Afiliado',
            'Codigo_certificado' => 'Codigo Certificado',
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
    public function getCodigoCertificado()
    {
        return $this->hasOne(Certificado::className(), ['Codigo_certificado' => 'Codigo_certificado']);
    }
}

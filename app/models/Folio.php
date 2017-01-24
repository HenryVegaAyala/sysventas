<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "folio".
 *
 * @property integer $Codigo_Folio
 * @property string $Valor
 * @property string $Descripcion
 * @property string $Estado
 * @property string $Fecha_Modificada
 * @property string $Usuario_Modificado
 *
 * @property Cliente[] $clientes
 * @property Cliente[] $clientes0
 */
class Folio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'folio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_Folio'], 'required'],
            [['Codigo_Folio'], 'integer'],
            [['Fecha_Modificada', 'Usuario_Modificado'], 'safe'],
            [['Valor'], 'string', 'max' => 100],
            [['Descripcion'], 'string', 'max' => 200],
            [['Estado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Folio' => 'Codigo  Folio',
            'Valor' => 'Valor',
            'Descripcion' => 'Descripcion',
            'Estado' => 'Estado',
            'Fecha_Modificada' => 'Fecha  Modificada',
            'Usuario_Modificado' => 'Usuario  Modificado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['Codigo_Opc' => 'Codigo_Folio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes0()
    {
        return $this->hasMany(Cliente::className(), ['Codigo_Tlmk' => 'Codigo_Folio']);
    }
}

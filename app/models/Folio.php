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
            [['Valor','Descripcion'], 'required'],
            [['Codigo_Folio'], 'integer'],
            [['Fecha_Modificada', 'Usuario_Modificado'], 'safe'],
            [['Valor'], 'string', 'max' => 100],
            [['Valor'], 'match', 'pattern' => '/^[0-9]+$/','message' => 'Sólo se aceptan números'],
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
}

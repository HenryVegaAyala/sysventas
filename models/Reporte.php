<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reporte".
 *
 * @property integer $id
 * @property string $fecha_final
 * @property string $fecha_inicio
 */
class Reporte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporte';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_final', 'fecha_inicio'], 'required'],
            [['fecha_final', 'fecha_inicio'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_final' => 'Fecha Final',
            'fecha_inicio' => 'Fecha Inicio',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carrera".
 *
 * @property integer $codigo
 * @property string $Nombre
 */
class Carrera extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carrera';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo'], 'integer'],
            [['Nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'Nombre' => 'Nombre',
        ];
    }
}

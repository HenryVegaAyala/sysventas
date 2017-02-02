<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "distrito".
 *
 * @property integer $codigo
 * @property string $descripcion
 */
class Distrito extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'distrito';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo'], 'integer'],
            [['descripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'descripcion' => 'Descripcion',
        ];
    }
}

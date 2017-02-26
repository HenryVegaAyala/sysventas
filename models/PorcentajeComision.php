<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "porcentaje_comision".
 *
 * @property integer $Codigo
 * @property string $Codigo_usuario
 * @property string $Usuario
 * @property double $procentaje
 */
class PorcentajeComision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'porcentaje_comision';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['procentaje'], 'number'],
            [['Codigo_usuario'], 'string', 'max' => 10],
            [['Usuario'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo' => 'Codigo',
            'Codigo_usuario' => 'Codigo Usuario',
            'Usuario' => 'Usuario',
            'procentaje' => 'Procentaje',
        ];
    }
}

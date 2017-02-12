<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comision".
 *
 * @property integer $Codigo
 * @property string $Nombre
 * @property string $monto
 * @property string $porcentaje
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Estado
 * @property string $codigo_anfitrion
 * @property string $codigo_supervisor_anfitrion
 * @property string $codigo_jefe_anfitrion
 * @property string $no_access_closer
 * @property string $no_access_liner
 */
class Comision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comision';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo'], 'required'],
            [['Codigo'], 'integer'],
            [['monto', 'porcentaje'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado'], 'safe'],
            [['Nombre'], 'string', 'max' => 11],
            [['Usuario_Creado', 'Usuario_Modificado', 'codigo_anfitrion', 'codigo_supervisor_anfitrion', 'codigo_jefe_anfitrion', 'no_access_closer', 'no_access_liner'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo' => 'Codigo',
            'Nombre' => 'Nombre',
            'monto' => 'Monto',
            'porcentaje' => 'Porcentaje',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Estado' => 'Estado',
            'codigo_anfitrion' => 'Codigo Anfitrion',
            'codigo_supervisor_anfitrion' => 'Codigo Supervisor Anfitrion',
            'codigo_jefe_anfitrion' => 'Codigo Jefe Anfitrion',
            'no_access_closer' => 'No Access Closer',
            'no_access_liner' => 'No Access Liner',
        ];
    }
}

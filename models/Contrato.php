<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contrato".
 *
 * @property integer $Codigo_Contrato
 * @property string $Nombre
 * @property string $Apellidos
 * @property string $Titular
 * @property string $Esposo
 * @property integer $Dni_1
 * @property integer $Dni_2
 * @property string $Estado_Civil_1
 * @property string $Estado_Civil_2
 * @property string $Domicilio_1
 * @property string $Domicilio_2
 * @property string $Ocupacion_1
 * @property string $Ocupacion_2
 * @property string $Monto_Pagado
 * @property string $Saldos
 * @property integer $N_cuotas
 * @property string $causas
 * @property string $Penalizacion
 * @property string $Formas
 * @property string $Monto_devol
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 */
class Contrato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contrato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['Nombre', 'Apellidos'], 'match', 'pattern' => "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\_\-\/\. ]+$/i", 'message' => 'Sólo se aceptan letras'],

            [['Codigo_Contrato', 'Dni_1'], 'integer', 'message' => 'Debe ser númerico.'],
            [['Dni_1'], 'match', 'pattern' => "/^.{6,8}$/", 'message' => 'DNI debe ser correcto'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Contrato' => 'Codigo del  Contrato',
            'Nombre' => 'Nombres',
            'Apellidos' => 'Apellidos',
            'Titular' => 'Titular',
            'Esposo' => 'Esposo',
            'Dni_1' => 'Dni',
            'Dni_2' => 'Dni 2',
            'Estado_Civil_1' => 'Estado Civil',
            'Estado_Civil_2' => 'Estado  Civil 2',
            'Domicilio_1' => 'Domicilio 1',
            'Domicilio_2' => 'Domicilio 2',
            'Ocupacion_1' => 'Ocupación',
            'Ocupacion_2' => 'Ocupacion 2',
            'Monto_Pagado' => 'Monto  Pagado',
            'Saldos' => 'Saldos',
            'N_cuotas' => 'N Cuotas',
            'causas' => 'Causas',
            'Penalizacion' => 'Penalizacion',
            'Formas' => 'Formas',
            'Monto_devol' => 'Monto Devol',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Estado' => 'Estado',
        ];
    }
}

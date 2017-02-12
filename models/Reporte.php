<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reporte".
 *
 * @property integer $id
 * @property string $fecha_final
 * @property string $fecha_inicio
 * @property integer $estado
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
            [['id', 'estado'], 'integer'],
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
            'estado' => 'Estado',
        ];
    }

    public function getEstado()
    {
        $var = [
            2 => 'Cita Concretada',
            3 => 'Cita Pendiente',
            4 => 'N/Q',
            5 => 'N/I',
            6 => 'D/F',
            7 => 'N/C',
            8 => 'Apagado',
        ];

        return $var;
    }

    public function getEstadoNombre($rol)
    {
        switch ($rol) {
            case 2:
                return 'Cita Concretada';
                break;
            case 3:
                return 'Cita Pendiente';
                break;
            case 4:
                return 'N/Q';
                break;
            case 5:
                return 'N/I';
                break;
            case 6:
                return 'D/F';
                break;
            case 7:
                return 'N/C';
                break;
            case 8:
                return 'Apagado';
                break;
            default:
                return 'Sin permiso';
        }
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property integer $Cod_Rol
 * @property string $Descripcion
 * @property string $Fecha_Creada
 * @property string $Fecha_Modificada
 * @property string $Fecha_Eliminada
 * @property string $Estado
 *
 * @property Usuario[] $usuarios
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Cod_Rol'], 'required'],
            [['Cod_Rol'], 'integer'],
            [['Fecha_Creada', 'Fecha_Modificada', 'Fecha_Eliminada', 'Estado'], 'safe'],
            [['Descripcion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Cod_Rol' => 'Cod  Rol',
            'Descripcion' => 'Descripcion',
            'Fecha_Creada' => 'Fecha  Creada',
            'Fecha_Modificada' => 'Fecha  Modificada',
            'Fecha_Eliminada' => 'Fecha  Eliminada',
            'Estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['Codigo_Rol' => 'Cod_Rol']);
    }

    public function getRol($rol)
    {
        switch ($rol) {
            case 1:
                return 'Anfitrión';
                break;
            case 2:
                return 'Supervisor';
                break;
            case 3:
                return 'Digitador';
                return;
            case 4:
                return 'Director de mercadeo';
                return;
            case 5:
                return 'Telemarketing';
                return;
            case 6:
                return 'Confirmador';
                return;
            case 7:
                return 'Supervisora de telemarketing';
                return;
            case 8:
                return 'No access liner';
                return;
            case 9:
                return 'No access closer';
                return;
            case 10:
                return 'Jefe de contratos';
                return;
            case 11:
                return 'Jefe de sala';
                return;
            case 12:
                return 'Jefe de ventas';
                break;
            case 13:
                return 'Director de proyecto';
                break;
            case 14:
                return 'Gerente General';
                break;
            default:
                return 'Sin permiso';
        }
    }
}

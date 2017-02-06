<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telemarketing".
 *
 * @property integer $Codigo
 * @property integer $item
 * @property string $nombre
 * @property string $apellido
 * @property string $profesion
 * @property string $direccion
 * @property integer $telefono
 * @property integer $CodOPC
 * @property integer $codTLMK
 * @property string $observacion
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 */
class Telemarketing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'telemarketing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fecha_Creado', 'Fecha_Modificado'], 'required'],
            [['item', 'telefono', 'CodOPC', 'codTLMK'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['nombre', 'apellido', 'profesion', 'direccion', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['observacion'], 'string', 'max' => 180],
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
            'item' => 'Item',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'profesion' => 'Profesion',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'CodOPC' => 'Cod Opc',
            'codTLMK' => 'Cod Tlmk',
            'observacion' => 'Observacion',
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

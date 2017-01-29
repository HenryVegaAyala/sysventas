<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documento".
 *
 * @property integer $Codigo_Documento
 * @property string $Nombre
 * @property string $archivo
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Eliminado
 * @property string $Usuario_Modificado
 * @property string $Estado
 */
class Documento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_Documento'], 'required'],
            [['Codigo_Documento'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Nombre'], 'string', 'max' => 45],
            [['archivo'], 'string', 'max' => 200],
            [['Usuario_Creado', 'Usuario_Eliminado', 'Usuario_Modificado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Documento' => 'Codigo  Documento',
            'Nombre' => 'Nombre',
            'archivo' => 'Archivo',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Estado' => 'Estado',
        ];
    }
}

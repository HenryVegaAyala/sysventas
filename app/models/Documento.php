<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "documento".
 *
 * @property integer $Codigo_Documento
 * @property string $Nombre
 * @property string $archivo
 * @property string $extension
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Eliminado
 * @property string $Usuario_Modificado
 * @property string $Estado
 * @property string $Fecha_Creado
 */
class Documento extends \yii\db\ActiveRecord
{
    public $archivo2;

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
            [['Nombre', 'archivo', 'extension'], 'required'],
            [['Codigo_Documento'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Nombre'], 'string', 'max' => 45],
            [['Usuario_Creado', 'Usuario_Eliminado', 'Usuario_Modificado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],

            ['archivo', 'file',
//                'skipOnEmpty' => false,
                'uploadRequired' => 'No has seleccionado ningún archivo', //Error
                'maxSize' => 1024 * 1024 * 2, //1 MB
                'tooBig' => 'El tamaño máximo permitido es 2MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'pdf, jpg, png',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
                'maxFiles' => 4,
                'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Documento' => 'Codigo  Documento',
            'Nombre' => 'Descripción',
            'archivo' => 'Archivo',
            'extension' => 'Extension',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Estado' => 'Estado',
            'Fecha_Creado' => 'Fecha  Creado',
        ];
    }

    public function getCodigoDocumento()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_Documento), 0) + 1');
        $query->select($expresion)->from('documento');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

}
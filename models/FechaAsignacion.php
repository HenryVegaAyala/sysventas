<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "fecha_asignacion".
 *
 * @property integer $codigo_asig
 * @property string $Fecha_Creada
 * @property string $Fecha_Modificada
 * @property string $Fecha_Eliminada
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Fecha_Llamado
 * @property string $Estado
 *
 * @property AsigTlmkCliente[] $asigTlmkClientes
 */
class FechaAsignacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fecha_asignacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fecha_Creada', 'Fecha_Modificada', 'Fecha_Eliminada'], 'safe'],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Fecha_Llamado', 'Estado'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo_asig' => 'Codigo Asig',
            'Fecha_Creada' => 'Fecha  Creada',
            'Fecha_Modificada' => 'Fecha  Modificada',
            'Fecha_Eliminada' => 'Fecha  Eliminada',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Fecha_Llamado' => 'Fecha  Llamado',
            'Estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsigTlmkClientes()
    {
        return $this->hasMany(AsigTlmkCliente::className(), ['codigo_asig' => 'codigo_asig']);
    }


    public function getCodigo()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(codigo_asig), 0) + 1');
        $query->select($expresion)->from('fecha_asignacion');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function SP_Estado($codigo)
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand("call Estado_Cliente('".$codigo."')");
        $command->execute();
    }
}
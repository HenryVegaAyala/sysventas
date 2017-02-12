<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "asig_tlmk_cliente".
 *
 * @property integer $codigo
 * @property integer $Codigo_telemarketing
 * @property integer $Codigo_Cliente
 * @property string $Fecha_Creada
 * @property string $Fecha_Modificada
 * @property string $Fecha_Eliminada
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Fecha_Llamado
 * @property string $Estado
 * @property integer $fecha_asignacion_codigo
 *
 * @property Cliente $codigoCliente
 * @property Telemarketing $codigoTelemarketing
 * @property FechaAsignacion $fechaAsignacionCodigo
 */
class AsigTlmkCliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asig_tlmk_cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'Codigo_telemarketing', 'Codigo_Cliente', 'fecha_asignacion_codigo'], 'required'],
            [['codigo', 'Codigo_telemarketing', 'Codigo_Cliente', 'fecha_asignacion_codigo'], 'integer'],
            [['Fecha_Creada', 'Fecha_Modificada', 'Fecha_Eliminada'], 'safe'],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Fecha_Llamado', 'Estado'], 'string', 'max' => 45],
            [['Codigo_Cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Codigo_Cliente' => 'Codigo_Cliente']],
            [['Codigo_telemarketing'], 'exist', 'skipOnError' => true, 'targetClass' => Telemarketing::className(), 'targetAttribute' => ['Codigo_telemarketing' => 'Codigo']],
            [['fecha_asignacion_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => FechaAsignacion::className(), 'targetAttribute' => ['fecha_asignacion_codigo' => 'codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'Codigo_telemarketing' => 'Codigo Telemarketing',
            'Codigo_Cliente' => 'Codigo  Cliente',
            'Fecha_Creada' => 'Fecha  Creada',
            'Fecha_Modificada' => 'Fecha  Modificada',
            'Fecha_Eliminada' => 'Fecha  Eliminada',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Fecha_Llamado' => 'Fecha  Llamado',
            'Estado' => 'Estado',
            'fecha_asignacion_codigo' => 'Fecha Asignacion Codigo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoCliente()
    {
        return $this->hasOne(Cliente::className(), ['Codigo_Cliente' => 'Codigo_Cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoTelemarketing()
    {
        return $this->hasOne(Telemarketing::className(), ['Codigo' => 'Codigo_telemarketing']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFechaAsignacionCodigo()
    {
        return $this->hasOne(FechaAsignacion::className(), ['codigo' => 'fecha_asignacion_codigo']);
    }

    public function getTelemarking()
    {

        $resultado = ArrayHelper::map(
            Telemarketing::find()
                ->where('Estado = 1')->asArray()
                ->all(), 'Codigo', 'nombre');
        return $resultado;
    }

}

<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use app\models\Cliente;

/**
 * This is the model class for table "asig_tlmk_cliente".
 *
 * @property integer $codigo_asig
 * @property integer $codigo_tlmk_cliente
 * @property integer $Codigo_Usuario
 * @property integer $Codigo_Cliente
 * @property string $Fecha_Creada
 * @property string $Fecha_Modificada
 * @property string $Fecha_Eliminada
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Fecha_Llamado
 * @property string $Estado
 *
 * @property Cliente $codigoCliente
 * @property FechaAsignacion $codigoAsig
 * @property User $codigoUsuario
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
            [['codigo_asig', 'codigo_tlmk_cliente', 'Codigo_Usuario', 'Codigo_Cliente'], 'required'],
            [['codigo_asig', 'codigo_tlmk_cliente', 'Codigo_Usuario', 'Codigo_Cliente'], 'integer'],
            [['Fecha_Creada', 'Fecha_Modificada', 'Fecha_Eliminada'], 'safe'],
            [['Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Fecha_Llamado', 'Estado'], 'string', 'max' => 45],
            [['Codigo_Cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Codigo_Cliente' => 'Codigo_Cliente']],
            [['codigo_asig'], 'exist', 'skipOnError' => true, 'targetClass' => FechaAsignacion::className(), 'targetAttribute' => ['codigo_asig' => 'codigo_asig']],
            [['Codigo_Usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Codigo_Usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo_asig' => 'Codigo Asig',
            'codigo_tlmk_cliente' => 'Codigo Tlmk Cliente',
            'Codigo_Usuario' => 'Codigo  Usuario',
            'Codigo_Cliente' => 'Codigo  Cliente',
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
    public function getCodigoCliente()
    {
        return $this->hasOne(Cliente::className(), ['Codigo_Cliente' => 'Codigo_Cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoAsig()
    {
        return $this->hasOne(FechaAsignacion::className(), ['codigo_asig' => 'codigo_asig']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'Codigo_Usuario']);
    }

    public function getTelemarking()
    {
        $resultado = ArrayHelper::map(
            Usuario::find()
                ->where('auth_key = 5 and status = 1 and estado = 2 ')->asArray()
                ->all(), 'id', 'username');
        return $resultado;
    }

    public function getCliente()
    {

        $resultado = ArrayHelper::map(
            Cliente::find()
                ->select(['Codigo_Cliente' => 'Codigo_Cliente', 'fullname' => "concat(Nombre,' ',Apellido)"])
                ->where('Estado in(3,7,8,10)')->asArray()
                ->all(), 'Codigo_Cliente', 'fullname');
        return $resultado;
    }
    
}

<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "comision".
 *
 * @property integer $Codigo
 * @property integer $Codigo_venta
 * @property string $Digitador
 * @property string $OPC
 * @property string $Tienda
 * @property string $SupervisorPromotor
 * @property string $SuperviorGeneralOPC
 * @property string $DirectordeMercadero
 * @property string $TLMK
 * @property string $SupervisordeTLMK
 * @property string $Confirmadora
 * @property string $DirectordeTLMK
 * @property string $Liner
 * @property string $Closer
 * @property string $Closer2
 * @property string $JefedeSala
 * @property string $DirectordeVentas
 * @property string $DirectordeProyectos
 * @property string $GenerenciaGeneral
 * @property string $monto
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Estado
 *
 * @property string $directordePlaneamiento
 * @property string $asesordePlaneamiento
 *
 * @property Venta $codigoVenta
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
            [['Codigo_venta'], 'required'],
            [['Codigo_venta'], 'integer'],
            [['monto'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado'], 'safe'],
            [['directordePlaneamiento','asesordePlaneamiento','Digitador', 'OPC', 'Tienda', 'SupervisorPromotor', 'SuperviorGeneralOPC', 'DirectordeMercadero', 'TLMK', 'SupervisordeTLMK', 'Confirmadora', 'DirectordeTLMK', 'Liner', 'Closer', 'Closer2', 'JefedeSala', 'DirectordeVentas', 'DirectordeProyectos', 'GenerenciaGeneral'], 'string', 'max' => 255],
            [['Usuario_Creado', 'Usuario_Modificado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['Codigo_venta'], 'exist', 'skipOnError' => true, 'targetClass' => Venta::className(), 'targetAttribute' => ['Codigo_venta' => 'Codigo_venta']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo' => 'Codigo',
            'Codigo_venta' => 'Codigo Venta',

            'Digitador' => 'Digitador',
            'OPC' => 'OPC',
            'Tienda' => 'Tienda',
            'SupervisorPromotor' => 'Supervisor Promotor',
            'SuperviorGeneralOPC' => 'Supervior General OPC',
            'DirectordeMercadero' => 'Directorde Mercadero',
            'TLMK' => 'TLMK',
            'SupervisordeTLMK' => 'Supervisor de TLMK',
            'Confirmadora' => 'Confirmadora',
            'DirectordeTLMK' => 'Director de TLMK',
            'Liner' => 'Liner',
            'Closer' => 'Closer',
            'Closer2' => 'Closer 2',
            'JefedeSala' => 'Jefe de Sala',
            'DirectordeVentas' => 'Director de Ventas',
            'DirectordeProyectos' => 'Director de Proyectos',
            'GenerenciaGeneral' => 'Generencia General',
            'directordePlaneamiento' => 'Dir. de Planeamiento',
            'asesordePlaneamiento' => 'Asesor de Planeamiento',

            'monto' => 'Monto',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoVenta()
    {
        return $this->hasOne(Venta::className(), ['Codigo_venta' => 'Codigo_venta']);
    }

    public function getCodigo()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo), 0) + 1');
        $query->select($expresion)->from('comision');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getCodigoComision($id)
    {
        $query = new Query();
        $select = new Expression('Codigo');
        $where = new Expression('Codigo_venta  = "'.$id.'"');
        $query->select($select)->from('comision')->where($where);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function comision($monto,$usuario){

        $query = new Query();
        $select = new Expression('auth_key');
        $where = new Expression('id_personal  = "'.$usuario.'"');
        $query->select($select)->from('user')->where($where);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();

        $select = new Expression('procentaje');
        $where = new Expression('Usuario  = "'.$data.'"');
        $query->select($select)->from('porcentaje_comision')->where($where);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();

        $res = ($monto*$data)/100;

        return $res;


    }


}

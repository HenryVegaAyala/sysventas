<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $Codigo_Cliente
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Profesion
 * @property integer $Edad
 * @property string $Estado_Civil
 * @property string $Distrito
 * @property string $Direccion
 * @property string $Telefono_Casa
 * @property string $Telefono_Casa2
 * @property string $Telefono_Celular
 * @property string $Telefono_Celular2
 * @property string $Telefono_Celular3
 * @property string $Email
 * @property string $Traslado
 * @property integer $Tarjeta_De_Credito
 * @property string $Promotor
 * @property string $Local
 * @property string $Observacion
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 * @property string $Agendado
 * @property integer $dni
 * @property string $Super_Promotor
 * @property string $Jefe_Promotor
 *
 * @property AsigTlmkCliente[] $asigTlmkClientes
 * @property Beneficiario[] $beneficiarios
 * @property Factura[] $facturas
 */
class Cliente extends \yii\db\ActiveRecord
{
    // variable temporal
    /**
     * @var
     */
    public $uso_interno;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'cliente';
    }

    public function rules()
    {
        return [
            [['Nombre', 'Apellido', 'Estado_Civil', 'Distrito', 'Profesion', 'Direccion', 'dni'], 'required'],
            [['Edad'], 'required', 'message' => 'Edad es requerida.'],
            [['dni'], 'required', 'message' => 'DNI es requerido.'],
            [['Codigo_Cliente', 'Edad', 'Tarjeta_De_Credito'], 'integer', 'message' => 'Debe ser númerico.'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Agendado'], 'safe'],
            [['Nombre', 'Apellido', 'Distrito', 'Local', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Super_Promotor', 'Jefe_Promotor'], 'string', 'max' => 100],
            [['Profesion', 'Email', 'Traslado'], 'string', 'max' => 45],
            [['Estado_Civil', 'Estado'], 'string', 'max' => 2],
            [['Direccion', 'Observacion'], 'string', 'max' => 200],
            [['Promotor'], 'string', 'max' => 50],

            [['Nombre', 'Apellido', 'Distrito', 'Profesion'], 'match', 'pattern' => "/^.{3,80}$/", 'message' => 'Mínimo 3 caracteres'],
            [['Nombre', 'Apellido', 'Distrito', 'Profesion'], 'match', 'pattern' => "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\_\-\/\. ]+$/i", 'message' => 'Sólo se aceptan letras'],

            [['Telefono_Casa', 'Edad', 'Tarjeta_De_Credito', 'Telefono_Casa2', 'Telefono_Celular', 'Telefono_Celular2', 'Telefono_Celular3', 'Traslado', 'dni'], 'integer', 'message' => 'Debe ser númerico.'],
            [['Telefono_Casa', 'Telefono_Casa2', 'Telefono_Celular', 'Telefono_Celular2', 'Telefono_Celular3'], 'match', 'pattern' => "/^.{3,15}$/", 'message' => 'Mínimo 7 caracteres'],
            [['dni'], 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Debe tener 8 digitos'],
            [['Edad'], 'match', 'pattern' => "/^.{2,2}$/", 'message' => 'Debe ser edad correcta'],

            [['Email'], 'match', 'pattern' => "/^.{3,45}$/", 'message' => 'Mínimo 3 caracteres del correo'],
            [['Email'], 'email', 'message' => 'Debe de ser un correo válido'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Cliente' => 'Codigo  Cliente',
            'Nombre' => 'Nombres',
            'Apellido' => 'Apellidos',
            'Profesion' => 'Profesión',
            'Edad' => 'Edad',
            'Estado_Civil' => 'Estado  Civil',
            'Distrito' => 'Distrito',
            'Direccion' => 'Dirección',
            'Telefono_Casa' => 'Teléfono de Casa 1',
            'Telefono_Casa2' => 'Teléfono de Casa 2',
            'Telefono_Celular' => 'Teléfono de Celular 1',
            'Telefono_Celular2' => 'Teléfono de Celular 2',
            'Telefono_Celular3' => 'Teléfono de Celular 3',
            'Email' => 'Correo Electrónico',
            'Traslado' => 'Traslado',
            'Tarjeta_De_Credito' => 'Tipo de Tarjeta',
            'Promotor' => 'Promotor',
            'Local' => 'Local',
            'Observacion' => 'Observacion',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Estado' => 'Estado',
            'Agendado' => 'Agendado',
            'dni' => 'DNI',
            'Super_Promotor' => 'Supervisor del Promotor',
            'Jefe_Promotor' => 'Jefe del Promotor'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsigTlmkClientes()
    {
        return $this->hasMany(AsigTlmkCliente::className(), ['Codigo_Cliente' => 'Codigo_Cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeneficiarios()
    {
        return $this->hasMany(Beneficiario::className(), ['Codigo_Cliente' => 'Codigo_Cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['Codigo_Cliente' => 'Codigo_Cliente']);
    }

    // Obtiene los distritos
    public function getDistrito()
    {
        $data = Distrito::find()
            ->select(['descripcion as value', 'descripcion as label'])
            ->asArray()
            ->all();
        return $data;
    }

    // Obtiene la carrera
    public function getCarrera()
    {
        $data = Carrera::find()
            ->select(['Nombre as value', 'Nombre as label'])
            ->asArray()
            ->all();
        return $data;
    }

    // obtiene el estado civil
    public function getEstadoCivil()
    {
        $var = [
            0 => 'Soltero/a',
            1 => 'Comprometido/a',
            2 => 'Casado/a',
            3 => 'Divorciado/a',
            4 => 'Viudo/a'
        ];
        return $var;
    }

    // mandas un parametro en entero y te devuelve que estado civil
    /**
     * @param $estado entero
     * @return string
     */
    public function EstadoCivil($estado)
    {
        switch ($estado) {
            case 0:
                return 'Soltero/a';
                break;
            case 1:
                return 'Comprometido/a';
                break;
            case 2:
                return 'Casado/a';
                break;
            case 3:
                return 'Divorciado/a';
                break;
            case 4:
                return 'Viudo/a';
                break;
        }
    }

    // obtiene el medio de mobilidad
    /**
     * @return array
     */
    public function getTraslado()
    {
        $var = [
            0 => 'Particular',
            1 => 'Bus',
        ];
        return $var;
    }

    // obtiene el tipo de tarjeta
    public function getTarjeta()
    {
        $var = [
            0 => 'Tarjeta de Crédito',
            1 => 'Tarjeta de Débito',
        ];
        return $var;
    }

    // Obtienes el AI del PK de Cliente
    public function getCodigoCliente()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_Cliente), 0) + 1');
        $query->select($expresion)->from('cliente');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    // Actualizacion de Cliente cuando sea eliminado
    /**
     * @param $id                   Codigo del cliente
     * @param $fh_delete            Fecha Eliminado
     * @param $usuario              Usuario Eliminado
     * @param $estado               Estado que pertence es 0 "Eliminado"
     * @throws \yii\db\Exception
     */
    public function ActualizarUsuario($id, $fh_delete, $usuario, $estado)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("UPDATE cliente SET 
                            Fecha_Eliminado = '" . $fh_delete . "',
                            Estado = '" . $estado . "',
                            Usuario_Eliminado = '" . $usuario . "'  
                            WHERE Codigo_Cliente = '" . $id . "';")->execute();
        $transaction->commit();

    }

    // Agendar al Cliente para una proxima llamada
    /**
     * @param $fh_Agendado          Fecha Agendado
     * @param $estado               Estado que pertenece es 3
     * @param $codigo               Codigo del cliente
     * @throws \yii\db\Exception
     */
    public function Agendar($fh_Agendado, $estado, $codigo)
    {
        if($fh_Agendado == null){
            $fhCreado = 'now()';
        }else{
            $fhCreado = $fh_Agendado;
        }


        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("UPDATE cliente SET 
                            Fecha_Creado = " . $fhCreado . ",
                            Estado = '" . $estado . "'
                            WHERE Codigo_Cliente = '" . $codigo . "';")->execute();
        $transaction->commit();

    }

    // Obtienes el Nombres y Apellido del cliente
    /**
     * @param $codigo               Codigo del cliente
     * @return false|null|string
     */
    public function Cliente($codigo)
    {
        $query = new Query();
        $expresion = new Expression("concat(Nombre,' ',Apellido)");
        $query->select($expresion)->from('cliente')->where("Codigo_Cliente ='" . $codigo . "'");
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    // Puedes buscar la caracteristica del cliente en base a direccion o dni
    /**
     * @param $codigo               Codigo del cliente
     * @param $tipo                 Caracterisca que desea llamar
     * @return false|null|string
     */
    public function DataCliente($codigo, $tipo)
    {
        $query = new Query();

        if ($tipo == 1) {
            $expresion = new Expression("dni");
        } elseif ($tipo == 2) {
            $expresion = new Expression("concat(Direccion,' ','-',' ',Distrito)");
        } elseif ($tipo == 3) {
            $expresion = new Expression("estado");
        }
        $query->select($expresion)->from('cliente')->where("Codigo_Cliente ='" . $codigo . "'");
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    // Obtienes el nombre y apellido del beneficiario
    /**
     * @param $codigo               Codigo del cliente
     * @return array|\yii\db\ActiveRecord[]
     */
    public function Beneficiario($codigo)
    {
        $expresion = new Expression("concat(Nombre,' ',Apellido) as dato");
        $data = Beneficiario::find()->select($expresion)->where("Codigo_Cliente ='" . $codigo . "'")->asArray()->all();
        return $data;
    }

    // Elimina al beneficiario para el insert Detalle
    /**
     * @param $codigo               Codigo del cliente
     * @throws \yii\db\Exception
     */
    public function SP_Delete($codigo)
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand("call Delete_Beneficiario('" . $codigo . "')");
        $command->execute();
    }

    // Cambia el estado del cliente a 11 "Confirmado"
    /**
     * @param $codigo               Codigo del cliente
     * @throws \yii\db\Exception
     */
    public function SP_Confirmar($codigo)
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand("call Confirmar('" . $codigo . "')");
        $command->execute();
    }

    // Extrae informacion del cliente
    /**
     * @param $codigo               Codigo del cliente
     * @param $valor                Es tipo de valor a buscar en la funcion
     * @return false|null|string    return un where
     */
    public function Datoscliente($codigo, $valor)
    {
        $query = new Query();
        $model = new Cliente();
        $expresion = $model->Valor($valor);
        $query->select($expresion)->from('cliente')->where("Codigo_Cliente ='" . $codigo . "'");
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    // Mandas un valor para que traiga un where
    /**
     * @param $valor                Codigo puede ser 1,2,3,4
     * @return Expression
     */
    public function Valor($valor)
    {
        switch ($valor) {
            case 0:
                $expresion = new Expression("Edad");
                return $expresion;
                break;
            case 1:
                $expresion = new Expression("Estado_Civil");
                return $expresion;
                break;
            case 2:
                $expresion = new Expression("Telefono_Casa");
                return $expresion;
                break;
            case 3:
                return $expresion = new Expression("Telefono_Celular");
                return $expresion;
                break;
            case 4:
                $expresion = new Expression("Email");
                return $expresion;
                break;
            case 5:
                $expresion = new Expression("estado");
                return $expresion;
                break;
        }
    }

    // Buscas el tipo de tarjeta
    /**
     * @param $valor
     * @return string
     */
    public function Tarjeta($valor)
    {
        switch ($valor) {
            case 0:
                return 'Tarjeta de Crédito';
                break;
            case 1:
                return 'Tarjeta de Débito';
                break;
        }
    }

    // Validas si ya existe el nombre y apellido del cliente
    /**
     * @param $nombre
     * @return int
     */
    public function NombreValidador($nombre)
    {
        $query = new Query();
        $codigo = new Expression('Codigo_Cliente');
        $where = new Expression("trim(concat(Nombre,' ',Apellido)) = " . "'$nombre'");
        $query->select($codigo)->from('cliente')->where($where);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();

        if ($data == true) {
            return 1;
        } else
            return 0;

    }

    // Concatenas dos cadenas para un query
    /**
     * @return string
     */
    public function getfullName()
    {
        return $this->Nombre . ' ' . $this->Apellido;
    }

}
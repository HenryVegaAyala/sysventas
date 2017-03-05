<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "cotitular".
 *
 * @property integer $Codigo_Cotitular
 * @property integer $Codigo_Cliente
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Profesion
 * @property integer $Edad
 * @property string $Estado_Civil
 * @property string $Distrito
 * @property string $Direccion
 * @property string $Telefono_Casa
 * @property string $Telefono_Celular
 * @property string $Email
 * @property string $Traslado
 * @property integer $Tarjeta_De_Credito
 * @property string $Promotor
 * @property string $Local
 * @property string $Observacion
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $dni
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 * @property string $Telefono_Casa2
 * @property string $Telefono_Celular2
 * @property string $Telefono_Celular3
 *
 * @property Cliente $codigoCliente
 */
class Cotitular extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cotitular';
    }

    public function rules()
    {
        return [

            [['Codigo_Cotitular', 'Codigo_Cliente', 'Edad', 'Tarjeta_De_Credito'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Nombre', 'Apellido', 'Distrito', 'Local', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Profesion', 'Email', 'Traslado'], 'string', 'max' => 45],
            [['Estado_Civil'], 'string', 'max' => 1],
            [['Direccion', 'Observacion'], 'string', 'max' => 200],
            [['Telefono_Casa', 'Telefono_Celular', 'dni', 'Telefono_Casa2', 'Telefono_Celular2', 'Telefono_Celular3'], 'string', 'max' => 15],
            [['Promotor'], 'string', 'max' => 50],
            [['Estado'], 'string', 'max' => 2],
            [['Codigo_Cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Codigo_Cliente' => 'Codigo_Cliente']],

            [['Nombre', 'Apellido', 'Distrito', 'Profesion'], 'match', 'pattern' => "/^.{3,80}$/", 'message' => 'Mínimo 3 caracteres'],
            [['Nombre', 'Apellido', 'Distrito', 'Profesion'], 'match', 'pattern' => "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\_\-\/\. ]+$/i", 'message' => 'Sólo se aceptan letras'],

            [['Telefono_Casa', 'Edad', 'Tarjeta_De_Credito', 'Telefono_Casa2', 'Telefono_Celular', 'Telefono_Celular2', 'Telefono_Celular3', 'Traslado', 'dni'], 'integer', 'message' => 'Debe ser númerico.'],
            [['Telefono_Casa', 'Telefono_Casa2', 'Telefono_Celular', 'Telefono_Celular2', 'Telefono_Celular3'], 'match', 'pattern' => "/^.{3,15}$/", 'message' => 'Mínimo 7 caracteres'],
            [['dni'], 'match', 'pattern' => "/^.{8,15}$/", 'message' => 'Minimo 8 digitos'],
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
            'Codigo_Cotitular' => 'Codigo  Cotitular',
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
            'dni' => 'DNI/Pasaporte',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
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

    public function getCodigo()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_Cotitular), 0) + 1');
        $query->select($expresion)->from('cotitular');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getCodigoCotitular($id)
    {
        $query = new Query();
        $select = new Expression('Codigo_Cotitular');
        $where = new Expression('Codigo_Cliente  = "'.$id.'"');
        $query->select($select)->from('cotitular')->where($where);
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

}

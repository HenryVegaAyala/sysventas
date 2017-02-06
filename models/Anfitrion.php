<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "anfitrion".
 *
 * @property integer $Codigo
 * @property string $Nombre
 * @property string $Apellido
 * @property integer $DNI
 * @property integer $Edad
 * @property string $Cargo
 * @property string $Telefono_Casa
 * @property string $Telefono_Celular
 * @property string $Turno
 * @property string $Descanso
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 * @property string $Encargado
 */
class Anfitrion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anfitrion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre', 'Apellido', 'Cargo', 'DNI', 'Edad'], 'required'],
            [['Codigo', 'DNI', 'Edad'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Nombre', 'Apellido', 'Cargo', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Telefono_Casa', 'Telefono_Celular'], 'string', 'max' => 15],
            [['Turno', 'Descanso'], 'string', 'max' => 45],
            [['Estado','Encargado'], 'string', 'max' => 1],

            [['Nombre', 'Apellido'], 'match', 'pattern' => "/^.{3,80}$/", 'message' => 'Mínimo 3 caracteres'],
            [['Nombre', 'Apellido'], 'match', 'pattern' => "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s\_\-\/\. ]+$/i", 'message' => 'Sólo se aceptan letras'],

            [['Edad', 'Telefono_Celular', 'Telefono_Casa'], 'integer', 'message' => 'Debe ser númerico.'],
            [['Telefono_Casa', 'Telefono_Celular'], 'match', 'pattern' => "/^.{3,15}$/", 'message' => 'Mínimo 7 caracteres del correo'],
            [['Edad'], 'match', 'pattern' => "/^.{2,2}$/", 'message' => 'Debe ser edad correcta'],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo' => 'Codigo',
            'Nombre' => 'Nombre',
            'Apellido' => 'Apellido',
            'DNI' => 'Dni',
            'Edad' => 'Edad',
            'Cargo' => 'Cargo',
            'Telefono_Casa' => 'Telefono  Casa',
            'Telefono_Celular' => 'Telefono  Celular',
            'Turno' => 'Turno',
            'Descanso' => 'Día de descanso',
            'Fecha_Creado' => 'Fecha  Solicitada',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Estado' => 'Estado',
            'Encargado' => 'Encargado de Tienda',
        ];
    }

    public function getCodigoAnfitrion()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo), 0) + 1');
        $query->select($expresion)->from('anfitrion');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function getEncargado()
    {
        $var = [
            1 => 'Si',
            0 => 'No',
        ];
        return $var;
    }

    public function getTurno()
    {
        $var = [
            0 => 'Mañana',
            1 => 'Tarde',
            2 => 'Noche',
        ];
        return $var;
    }

    public function getDiaDescanso()
    {
        $var = [
            0 => 'Lunes',
            1 => 'Martes',
            2 => 'Miercoles',
            3 => 'Jueves',
            4 => 'Viernes',
            5 => 'Sabado',
            6 => 'Domingo',
        ];
        return $var;
    }

    public function ActualizarUsuario($id, $fh_delete, $usuario, $estado)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("UPDATE anfitrion SET 
                            Fecha_Eliminado = '" . $fh_delete . "',
                            Estado = '" . $estado . "',
                            Usuario_Eliminado = '" . $usuario . "'  
                            WHERE Codigo = '" . $id . "';")->execute();
        $transaction->commit();

    }

    public function getTurnoView($turno)
    {
        switch ($turno) {
            case 0:
                return 'Mañana';
                break;
            case 1:
                return 'Tarde';
                break;
            case 2:
                return 'Noche';
                break;
        }
    }

    public function getDiaDescansoView($dia)
    {
        switch ($dia) {
            case 0:
                return 'Lunes';
                break;
            case 1:
                return 'Martes';
                break;
            case 2:
                return 'Miercoles';
                break;
            case 3:
                return 'Jueves';
                break;
            case 4:
                return 'Viernes';
                break;
            case 5:
                return 'Sabado';
                break;
            case 6:
                return 'Domingo';
                break;
        }
    }
}

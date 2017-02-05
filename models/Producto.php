<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "producto".
 *
 * @property integer $Codigo_Producto
 * @property string $Nombre
 * @property string $Precio
 * @property string $Precio_por_Noche
 * @property integer $Vigencia
 * @property double $Desc_Afiliado
 * @property string $Fecha_Creado
 * @property string $Fecha_Modificado
 * @property string $Fecha_Eliminado
 * @property string $Usuario_Creado
 * @property string $Usuario_Modificado
 * @property string $Usuario_Eliminado
 * @property string $Estado
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre','Precio', 'Precio_por_Noche', 'Desc_Afiliado', 'Vigencia'], 'required'],
            [['Codigo_Producto', 'Vigencia'], 'integer'],
            [['Precio', 'Precio_por_Noche', 'Desc_Afiliado'], 'number'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado'], 'safe'],
            [['Nombre', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],



        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Producto' => 'Codigo  Producto',
            'Nombre' => 'Nombre',
            'Precio' => 'Precio',
            'Precio_por_Noche' => 'Precio por  Noche',
            'Vigencia' => 'Vigencia',
            'Desc_Afiliado' => 'Descuento al Afiliado',
            'Fecha_Creado' => 'Fecha  Creado',
            'Fecha_Modificado' => 'Fecha  Modificado',
            'Fecha_Eliminado' => 'Fecha  Eliminado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Usuario_Modificado' => 'Usuario  Modificado',
            'Usuario_Eliminado' => 'Usuario  Eliminado',
            'Estado' => 'Estado',
        ];
    }

    public function getCodigoProducto()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_Producto), 0) + 1');
        $query->select($expresion)->from('producto');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }

    public function ActualizarProducto($id, $fh_delete, $usuario, $estado)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        $db->createCommand("UPDATE producto SET 
                            Fecha_Eliminado = '" . $fh_delete . "',
                            Estado = '" . $estado . "',
                            Usuario_Eliminado = '" . $usuario . "'  
                            WHERE Codigo_Producto = '" . $id . "';")->execute();
        $transaction->commit();

    }

    public function Pasaporte($codigo)
    {
        $query = new Query();
        $query->select('nombre')->from('producto')->where("Codigo_Producto ='" . $codigo . "'");
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }
}

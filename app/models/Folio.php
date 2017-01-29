<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "folio".
 *
 * @property integer $Codigo_Folio
 * @property string $Valor
 * @property string $Descripcion
 * @property string $Estado
 * @property string $Usuario_Creado
 * @property string $Fecha_Modificada
 * @property string $Fecha_Creada
 * @property string $Usuario_Modificado
 */
class Folio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'folio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Valor', 'Descripcion'], 'required'],
            [['Codigo_Folio'], 'integer'],
            [['Fecha_Modificada', 'Fecha_Creada'], 'safe'],
            [['Valor'], 'string', 'max' => 100],
            [['Valor'], 'match', 'pattern' => '/^[0-9]+$/', 'message' => 'Sólo se aceptan números'],
            [['Descripcion'], 'string', 'max' => 200],
            [['Estado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Codigo_Folio' => 'Codigo  Folio',
            'Valor' => 'Valor',
            'Descripcion' => 'Descripcion',
            'Estado' => 'Estado',
            'Usuario_Creado' => 'Usuario  Creado',
            'Fecha_Modificada' => 'Fecha  Modificada',
            'Fecha_Creada' => 'Fecha  Creada',
            'Usuario_Modificado' => 'Usuario  Modificado',
        ];
    }

    public function getCodigoFolio()
    {
        $query = new Query();
        $expresion = new Expression('IFNULL(MAX(Codigo_Folio), 0) + 1');
        $query->select($expresion)->from('folio');
        $comando = $query->createCommand();
        $data = $comando->queryScalar();
        return $data;
    }
}
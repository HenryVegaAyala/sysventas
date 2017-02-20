<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Venta;

/**
 * VentaSearch represents the model behind the search form about `app\models\Venta`.
 */
class VentaSearch extends Venta
{
    public function rules()
    {
        return [
            [['Codigo_venta', 'Codigo_club', 'Codigo_pasaporte', 'Codigo_Cliente', 'Estado'], 'integer'],
            [['numero_contrato', 'Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Venta::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Codigo_venta' => $this->Codigo_venta,
            'Codigo_club' => $this->Codigo_club,
            'Codigo_pasaporte' => $this->Codigo_pasaporte,
            'Codigo_Cliente' => $this->Codigo_Cliente,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
            'Fecha_Eliminado' => $this->Fecha_Eliminado,
            'Estado' => $this->Estado,
        ]);

        $query->andFilterWhere(['like', 'numero_contrato', $this->numero_contrato])
            ->andFilterWhere(['like', 'Usuario_Creado', $this->Usuario_Creado])
            ->andFilterWhere(['like', 'Usuario_Modificado', $this->Usuario_Modificado])
            ->andFilterWhere(['like', 'Usuario_Eliminado', $this->Usuario_Eliminado]);

        return $dataProvider;
    }
}

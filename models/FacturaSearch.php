<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Factura;

/**
 * FacturaSearch represents the model behind the search form about `app\models\Factura`.
 */
class FacturaSearch extends Factura
{
    public function rules()
    {
        return [
            [['id', 'Codigo_Cliente', 'Codigo_Combo'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Estado'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Factura::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'Codigo_Cliente' => $this->Codigo_Cliente,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
            'Fecha_Eliminado' => $this->Fecha_Eliminado,
            'Usuario_Creado' => $this->Usuario_Creado,
            'Usuario_Modificado' => $this->Usuario_Modificado,
            'Usuario_Eliminado' => $this->Usuario_Eliminado,
            'Codigo_Combo' => $this->Codigo_Combo,
        ]);

        $query->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }
}

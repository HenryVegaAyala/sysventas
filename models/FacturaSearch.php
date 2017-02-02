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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_Factura', 'Codigo_Cliente'], 'integer'],
            [['Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Estado'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Factura::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Codigo_Factura' => $this->Codigo_Factura,
            'Codigo_Cliente' => $this->Codigo_Cliente,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
            'Fecha_Eliminado' => $this->Fecha_Eliminado,
            'Usuario_Creado' => $this->Usuario_Creado,
            'Usuario_Modificado' => $this->Usuario_Modificado,
            'Usuario_Eliminado' => $this->Usuario_Eliminado,
        ]);

        $query->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }
}

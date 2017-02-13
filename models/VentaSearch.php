<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Venta;

/**
 * VentaSearch represents the model behind the search form of `app\models\Venta`.
 */
class VentaSearch extends Venta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_venta', 'Codigo_pasaporte', 'Codigo_Cliente'], 'integer'],
            [['medio_pago', 'Estado_pago', 'cod_barra_pasaporte', 'cod_barra_pasaporte_manual', 'Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Estado'], 'safe'],
            [['porcentaje_pagado'], 'number'],
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
        $query = Venta::find();

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
            'Codigo_venta' => $this->Codigo_venta,
            'Codigo_pasaporte' => $this->Codigo_pasaporte,
            'Codigo_Cliente' => $this->Codigo_Cliente,
            'porcentaje_pagado' => $this->porcentaje_pagado,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
            'Fecha_Eliminado' => $this->Fecha_Eliminado,
        ]);

        $query->andFilterWhere(['like', 'medio_pago', $this->medio_pago])
            ->andFilterWhere(['like', 'Estado_pago', $this->Estado_pago])
            ->andFilterWhere(['like', 'cod_barra_pasaporte', $this->cod_barra_pasaporte])
            ->andFilterWhere(['like', 'cod_barra_pasaporte_manual', $this->cod_barra_pasaporte_manual])
            ->andFilterWhere(['like', 'Usuario_Creado', $this->Usuario_Creado])
            ->andFilterWhere(['like', 'Usuario_Modificado', $this->Usuario_Modificado])
            ->andFilterWhere(['like', 'Usuario_Eliminado', $this->Usuario_Eliminado])
            ->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }
}

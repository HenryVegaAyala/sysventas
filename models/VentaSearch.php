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
            [['Codigo_venta', 'Codigo_club', 'Codigo_Cliente', 'medio_pago', 'Estado_pago', 'porcentaje_pagado', 'Estado', 'Factura_emitida', 'Codigo_pasaporte'], 'integer'],
            [['cod_barra_pasaporte', 'cod_barra_pasaporte_manual', 'Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado'], 'safe'],
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
            'Codigo_club' => $this->Codigo_club,
            'Codigo_Cliente' => $this->Codigo_Cliente,
            'medio_pago' => $this->medio_pago,
            'Estado_pago' => $this->Estado_pago,
            'porcentaje_pagado' => $this->porcentaje_pagado,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
            'Fecha_Eliminado' => $this->Fecha_Eliminado,
            'Estado' => $this->Estado,
            'Factura_emitida' => $this->Factura_emitida,
            'Codigo_pasaporte' => $this->Codigo_pasaporte,
        ]);

        $query->andFilterWhere(['like', 'cod_barra_pasaporte', $this->cod_barra_pasaporte])
            ->andFilterWhere(['like', 'cod_barra_pasaporte_manual', $this->cod_barra_pasaporte_manual])
            ->andFilterWhere(['like', 'Usuario_Creado', $this->Usuario_Creado])
            ->andFilterWhere(['like', 'Usuario_Modificado', $this->Usuario_Modificado])
            ->andFilterWhere(['like', 'Codigo_Cliente', $this->Codigo_Cliente])
            ->andFilterWhere(['like', 'Usuario_Eliminado', $this->Usuario_Eliminado]);

        return $dataProvider;
    }
}

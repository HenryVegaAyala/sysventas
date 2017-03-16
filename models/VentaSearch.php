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
            [['Codigo_venta', 'Codigo_club', 'Codigo_pasaporte', 'Codigo_Cliente', 'Estado', 'salas'], 'integer'],
            [['numero_contrato', 'Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'numero_pasaporte', 'numero_comprobante', 'serie_comprobante', 'razon_social', 'estado_pago'], 'safe'],
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
        $query = Venta::find()->where('Estado = 1')->orderBy('Fecha_Creado desc');

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
            'Codigo_pasaporte' => $this->Codigo_pasaporte,
            'Codigo_Cliente' => $this->Codigo_Cliente,
//            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
            'Fecha_Eliminado' => $this->Fecha_Eliminado,
            'Estado' => $this->Estado,
            'salas' => $this->salas,
        ]);

        $query->andFilterWhere(['like', 'numero_contrato', $this->numero_contrato])
            ->andFilterWhere(['like', 'Usuario_Creado', $this->Usuario_Creado])
            ->andFilterWhere(['like', 'Usuario_Modificado', $this->Usuario_Modificado])
            ->andFilterWhere(['like', 'Usuario_Eliminado', $this->Usuario_Eliminado])
            ->andFilterWhere(['like', 'numero_pasaporte', $this->numero_pasaporte])
            ->andFilterWhere(['like', 'numero_comprobante', $this->numero_comprobante])
            ->andFilterWhere(['like', 'serie_comprobante', $this->serie_comprobante])
            ->andFilterWhere(['like', 'razon_social', $this->razon_social])
            ->andFilterWhere(['like', 'estado_pago', $this->estado_pago]);

        $Fecha = $this->Fecha_Creado;
        if ($Fecha == false) {

        }else{
            $FechaIni = substr($Fecha, 0, 10);
            $FechaFin = substr($Fecha, -10);
            $query->andFilterWhere(['between', 'date(Fecha_Creado)', $FechaIni, $FechaFin]);
        }

        return $dataProvider;
    }
}

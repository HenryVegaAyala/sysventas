<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contrato;

/**
 * ContratoSearch represents the model behind the search form about `app\models\Contrato`.
 */
class ContratoSearch extends Contrato
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_Contrato', 'Dni_1', 'Dni_2', 'N_cuotas'], 'integer'],
            [['Nombre', 'Apellidos', 'Titular', 'Esposo', 'Estado_Civil_1', 'Estado_Civil_2', 'Domicilio_1', 'Domicilio_2', 'Ocupacion_1', 'Ocupacion_2', 'causas', 'Formas', 'Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Estado'], 'safe'],
            [['Monto_Pagado', 'Saldos', 'Penalizacion', 'Monto_devol'], 'number'],
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
        $query = Contrato::find()->where(['Estado' => 1]);

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
            'Codigo_Contrato' => $this->Codigo_Contrato,
            'Dni_1' => $this->Dni_1,
            'Dni_2' => $this->Dni_2,
            'Monto_Pagado' => $this->Monto_Pagado,
            'Saldos' => $this->Saldos,
            'N_cuotas' => $this->N_cuotas,
            'Penalizacion' => $this->Penalizacion,
            'Monto_devol' => $this->Monto_devol,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
            'Fecha_Eliminado' => $this->Fecha_Eliminado,
            'Usuario_Creado' => $this->Usuario_Creado,
            'Usuario_Modificado' => $this->Usuario_Modificado,
            'Usuario_Eliminado' => $this->Usuario_Eliminado,
        ]);
//
//        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
//            ->andFilterWhere(['like', 'Apellidos', $this->Apellidos])
//            ->andFilterWhere(['like', 'Titular', $this->Titular])
//            ->andFilterWhere(['like', 'Esposo', $this->Esposo])
//            ->andFilterWhere(['like', 'Estado_Civil_1', $this->Estado_Civil_1])
//            ->andFilterWhere(['like', 'Estado_Civil_2', $this->Estado_Civil_2])
//            ->andFilterWhere(['like', 'Domicilio_1', $this->Domicilio_1])
//            ->andFilterWhere(['like', 'Domicilio_2', $this->Domicilio_2])
//            ->andFilterWhere(['like', 'Ocupacion_1', $this->Ocupacion_1])
//            ->andFilterWhere(['like', 'Ocupacion_2', $this->Ocupacion_2])
//            ->andFilterWhere(['like', 'causas', $this->causas])
//            ->andFilterWhere(['like', 'Formas', $this->Formas])
//            ->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }
}

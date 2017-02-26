<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comision;

/**
 * ComisionSearch represents the model behind the search form of `app\models\Comision`.
 */
class ComisionSearch extends Comision
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo', 'Codigo_venta'], 'integer'],
            [['Digitador', 'OPC', 'Tienda', 'SupervisorPromotor', 'SuperviorGeneralOPC', 'DirectordeMercadero', 'TLMK', 'SupervisordeTLMK', 'Confirmadora', 'DirectordeTLMK', 'Liner', 'Closer', 'Closer2', 'JefedeSala', 'DirectordeVentas', 'DirectordeProyectos', 'GenerenciaGeneral', 'Fecha_Creado', 'Fecha_Modificado', 'Usuario_Creado', 'Usuario_Modificado', 'Estado'], 'safe'],
            [['monto'], 'number'],
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
        $query = Comision::find();

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
            'Codigo' => $this->Codigo,
            'Codigo_venta' => $this->Codigo_venta,
            'monto' => $this->monto,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
        ]);

        $query->andFilterWhere(['like', 'Digitador', $this->Digitador])
            ->andFilterWhere(['like', 'OPC', $this->OPC])
            ->andFilterWhere(['like', 'Tienda', $this->Tienda])
            ->andFilterWhere(['like', 'SupervisorPromotor', $this->SupervisorPromotor])
            ->andFilterWhere(['like', 'SuperviorGeneralOPC', $this->SuperviorGeneralOPC])
            ->andFilterWhere(['like', 'DirectordeMercadero', $this->DirectordeMercadero])
            ->andFilterWhere(['like', 'TLMK', $this->TLMK])
            ->andFilterWhere(['like', 'SupervisordeTLMK', $this->SupervisordeTLMK])
            ->andFilterWhere(['like', 'Confirmadora', $this->Confirmadora])
            ->andFilterWhere(['like', 'DirectordeTLMK', $this->DirectordeTLMK])
            ->andFilterWhere(['like', 'Liner', $this->Liner])
            ->andFilterWhere(['like', 'Closer', $this->Closer])
            ->andFilterWhere(['like', 'Closer2', $this->Closer2])
            ->andFilterWhere(['like', 'JefedeSala', $this->JefedeSala])
            ->andFilterWhere(['like', 'DirectordeVentas', $this->DirectordeVentas])
            ->andFilterWhere(['like', 'DirectordeProyectos', $this->DirectordeProyectos])
            ->andFilterWhere(['like', 'GenerenciaGeneral', $this->GenerenciaGeneral])
            ->andFilterWhere(['like', 'Usuario_Creado', $this->Usuario_Creado])
            ->andFilterWhere(['like', 'Usuario_Modificado', $this->Usuario_Modificado])
            ->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }
}

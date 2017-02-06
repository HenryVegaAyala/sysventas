<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Anfitrion;

/**
 * AnfitrionSearch represents the model behind the search form of `app\models\Anfitrion`.
 */
class AnfitrionSearch extends Anfitrion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo', 'DNI', 'Edad'], 'integer'],
            [['Nombre', 'Apellido', 'Cargo', 'Telefono_Casa', 'Telefono_Celular', 'Turno', 'Descanso', 'Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Estado'], 'safe'],
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
        $query = Anfitrion::find();

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
            'DNI' => $this->DNI,
            'Edad' => $this->Edad,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
            'Fecha_Eliminado' => $this->Fecha_Eliminado,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Apellido', $this->Apellido])
            ->andFilterWhere(['like', 'Cargo', $this->Cargo])
            ->andFilterWhere(['like', 'Telefono_Casa', $this->Telefono_Casa])
            ->andFilterWhere(['like', 'Telefono_Celular', $this->Telefono_Celular])
            ->andFilterWhere(['like', 'Turno', $this->Turno])
            ->andFilterWhere(['like', 'Descanso', $this->Descanso])
            ->andFilterWhere(['like', 'Usuario_Creado', $this->Usuario_Creado])
            ->andFilterWhere(['like', 'Usuario_Modificado', $this->Usuario_Modificado])
            ->andFilterWhere(['like', 'Usuario_Eliminado', $this->Usuario_Eliminado])
            ->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }
}

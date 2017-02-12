<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AsigTlmkCliente;

/**
 * AsigTlmkClienteSearch represents the model behind the search form of `app\models\AsigTlmkCliente`.
 */
class AsigTlmkClienteSearch extends AsigTlmkCliente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'Codigo_telemarketing', 'Codigo_Cliente', 'fecha_asignacion_codigo'], 'integer'],
            [['Fecha_Creada', 'Fecha_Modificada', 'Fecha_Eliminada', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Fecha_Llamado', 'Estado'], 'safe'],
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
        $query = AsigTlmkCliente::find();

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
            'codigo' => $this->codigo,
            'Codigo_telemarketing' => $this->Codigo_telemarketing,
            'Codigo_Cliente' => $this->Codigo_Cliente,
            'Fecha_Creada' => $this->Fecha_Creada,
            'Fecha_Modificada' => $this->Fecha_Modificada,
            'Fecha_Eliminada' => $this->Fecha_Eliminada,
            'fecha_asignacion_codigo' => $this->fecha_asignacion_codigo,
        ]);

        $query->andFilterWhere(['like', 'Usuario_Creado', $this->Usuario_Creado])
            ->andFilterWhere(['like', 'Usuario_Modificado', $this->Usuario_Modificado])
            ->andFilterWhere(['like', 'Usuario_Eliminado', $this->Usuario_Eliminado])
            ->andFilterWhere(['like', 'Fecha_Llamado', $this->Fecha_Llamado])
            ->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }
}

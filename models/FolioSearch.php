<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Folio;

/**
 * FolioSearch represents the model behind the search form about `app\models\Folio`.
 */
class FolioSearch extends Folio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_Folio'], 'integer'],
            [['Valor', 'Descripcion', 'Estado', 'Fecha_Modificada', 'Usuario_Modificado'], 'safe'],
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
        $query = Folio::find();

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
            'Codigo_Folio' => $this->Codigo_Folio,
            'Fecha_Modificada' => $this->Fecha_Modificada,
            'Usuario_Modificado' => $this->Usuario_Modificado,
        ]);

        $query->andFilterWhere(['like', 'Valor', $this->Valor])
            ->andFilterWhere(['like', 'Descripcion', $this->Descripcion])
            ->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PorcentajeComision;

/**
 * PorcentajeComisionSearch represents the model behind the search form of `app\models\PorcentajeComision`.
 */
class PorcentajeComisionSearch extends PorcentajeComision
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo'], 'integer'],
            [['Codigo_usuario', 'Usuario'], 'safe'],
            [['procentaje'], 'number'],
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
        $query = PorcentajeComision::find();

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
            'procentaje' => $this->procentaje,
        ]);

        $query->andFilterWhere(['like', 'Codigo_usuario', $this->Codigo_usuario])
            ->andFilterWhere(['like', 'Usuario', $this->Usuario]);

        return $dataProvider;
    }
}

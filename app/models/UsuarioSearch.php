<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form about `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_Usuario', 'Activate', 'Codigo_Rol'], 'integer'],
            [['Nombre', 'Apellido', 'Email', 'Contrasena', 'AuthKey', 'AccessToken', 'Fecha_Creado', 'Fecha_Modificada', 'Fecha_Eliminada', 'Ultima_Sesion', 'Estado'], 'safe'],
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
        $query = Usuario::find()->where(['Estado' => 1]);

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
            'Codigo_Usuario' => $this->Codigo_Usuario,
            'Activate' => $this->Activate,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificada' => $this->Fecha_Modificada,
            'Fecha_Eliminada' => $this->Fecha_Eliminada,
            'Ultima_Sesion' => $this->Ultima_Sesion,
            'Codigo_Rol' => $this->Codigo_Rol,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Apellido', $this->Apellido])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Contrasena', $this->Contrasena])
            ->andFilterWhere(['like', 'AuthKey', $this->AuthKey])
            ->andFilterWhere(['like', 'AccessToken', $this->AccessToken])
            ->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }
}

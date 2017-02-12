<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comision;
use yii\db\Query;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

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
            [['Codigo'], 'integer'],
            [['Nombre', 'Fecha_Creado', 'Fecha_Modificado', 'Usuario_Creado', 'Usuario_Modificado', 'Estado', 'codigo_anfitrion', 'codigo_supervisor_anfitrion', 'codigo_jefe_anfitrion', 'no_access_closer', 'no_access_liner'], 'safe'],
            [['monto', 'porcentaje'], 'number'],
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

        $model = new Usuario();
        $where = new Expression($model->getComisiones(Yii::$app->user->identity->Codigo_Rol, Yii::$app->user->identity->id));
        $query = Comision::find()->where($where);

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
            'monto' => $this->monto,
            'porcentaje' => $this->porcentaje,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Usuario_Creado', $this->Usuario_Creado])
            ->andFilterWhere(['like', 'Usuario_Modificado', $this->Usuario_Modificado])
            ->andFilterWhere(['like', 'Estado', $this->Estado])
            ->andFilterWhere(['like', 'codigo_anfitrion', $this->codigo_anfitrion])
            ->andFilterWhere(['like', 'codigo_supervisor_anfitrion', $this->codigo_supervisor_anfitrion])
            ->andFilterWhere(['like', 'codigo_jefe_anfitrion', $this->codigo_jefe_anfitrion])
            ->andFilterWhere(['like', 'no_access_closer', $this->no_access_closer])
            ->andFilterWhere(['like', 'no_access_liner', $this->no_access_liner]);

        return $dataProvider;
    }
}

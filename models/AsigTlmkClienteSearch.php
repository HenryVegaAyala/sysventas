<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AsigTlmkCliente;
use yii\db\Expression;
/**
 * AsigTlmkClienteSearch represents the model behind the search form about `app\models\AsigTlmkCliente`.
 */
class AsigTlmkClienteSearch extends AsigTlmkCliente
{
    public function rules()
    {
        return [
            [['codigo_asig', 'codigo_tlmk_cliente', 'Codigo_Usuario', 'Codigo_Cliente'], 'integer'],
            [['Fecha_Creada', 'Fecha_Modificada', 'Fecha_Eliminada', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Fecha_Llamado', 'Estado'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $model = new Usuario();
        $where = new Expression($model->getSubFiltros(Yii::$app->user->identity->Codigo_Rol,Yii::$app->user->identity->id));
        $query = AsigTlmkCliente::find()->where($where);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
//            'codigo_asig' => $this->codigo_asig,
//            'codigo_tlmk_cliente' => $this->codigo_tlmk_cliente,
//            'Codigo_Usuario' => $this->Codigo_Usuario,
            'Codigo_Cliente' => $this->Codigo_Cliente,
//            'Fecha_Creada' => $this->Fecha_Creada,
//            'Fecha_Modificada' => $this->Fecha_Modificada,
//            'Fecha_Eliminada' => $this->Fecha_Eliminada,
        ]);

        $query->andFilterWhere(['like', 'Codigo_Cliente', $this->Codigo_Cliente]);

        return $dataProvider;
    }
}

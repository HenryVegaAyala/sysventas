<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cliente;
use yii\db\Expression;

/**
 * ClienteSearch represents the model behind the search form about `app\models\Cliente`.
 */
class ClienteSearch extends Cliente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Codigo_Cliente', 'Edad', 'Tarjeta_De_Credito'], 'integer'],
            [['Nombre', 'Apellido', 'Profesion', 'Estado_Civil', 'Distrito', 'Direccion', 'Telefono_Casa', 'Telefono_Celular', 'Email', 'Traslado', 'Promotor', 'Local', 'Observacion', 'Fecha_Creado', 'Fecha_Modificado', 'Fecha_Eliminado', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Estado'], 'safe'],
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


    public function search($params)
    {
        $model = new Usuario();

        $CodigoRol = Yii::$app->user->identity->Codigo_Rol;
        $CodigoUsuario = Yii::$app->user->identity->id;

        $where = new Expression($model->getFiltros($CodigoRol,$CodigoUsuario));
        $query = Cliente::find()->where($where)->orderBy(['Codigo_Cliente' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {

            return $dataProvider;
        }

        $query->andFilterWhere([
            'Codigo_Cliente' => $this->Codigo_Cliente,
            'Edad' => $this->Edad,
            'Tarjeta_De_Credito' => $this->Tarjeta_De_Credito,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
            'Fecha_Eliminado' => $this->Fecha_Eliminado,
            'Usuario_Creado' => $this->Usuario_Creado,
            'Usuario_Modificado' => $this->Usuario_Modificado,
            'Usuario_Eliminado' => $this->Usuario_Eliminado,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Apellido', $this->Apellido])
            ->andFilterWhere(['like', 'Profesion', $this->Profesion])
            ->andFilterWhere(['like', 'Estado_Civil', $this->Estado_Civil])
            ->andFilterWhere(['like', 'Distrito', $this->Distrito])
            ->andFilterWhere(['like', 'Direccion', $this->Direccion])
            ->andFilterWhere(['like', 'Telefono_Casa', $this->Telefono_Casa])
            ->andFilterWhere(['like', 'Telefono_Celular', $this->Telefono_Celular])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Traslado', $this->Traslado])
            ->andFilterWhere(['like', 'Promotor', $this->Promotor])
            ->andFilterWhere(['like', 'Local', $this->Local])
            ->andFilterWhere(['like', 'Observacion', $this->Observacion])
            ->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }

    public function searchAsignacion($params)
    {
        $model = new Usuario();

        $CodigoRol = Yii::$app->user->identity->Codigo_Rol;
        $CodigoUsuario = Yii::$app->user->identity->id;

        $where = new Expression($model->getFiltros($CodigoRol,$CodigoUsuario));
        $query = AsigTlmkCliente::find()->where($where)->orderBy(['Fecha_Creada' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {

            return $dataProvider;
        }

        $query->andFilterWhere([
            'Codigo_Cliente' => $this->Codigo_Cliente,
            'Edad' => $this->Edad,
            'Tarjeta_De_Credito' => $this->Tarjeta_De_Credito,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
            'Fecha_Eliminado' => $this->Fecha_Eliminado,
            'Usuario_Creado' => $this->Usuario_Creado,
            'Usuario_Modificado' => $this->Usuario_Modificado,
            'Usuario_Eliminado' => $this->Usuario_Eliminado,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Apellido', $this->Apellido])
            ->andFilterWhere(['like', 'Profesion', $this->Profesion])
            ->andFilterWhere(['like', 'Estado_Civil', $this->Estado_Civil])
            ->andFilterWhere(['like', 'Distrito', $this->Distrito])
            ->andFilterWhere(['like', 'Direccion', $this->Direccion])
            ->andFilterWhere(['like', 'Telefono_Casa', $this->Telefono_Casa])
            ->andFilterWhere(['like', 'Telefono_Celular', $this->Telefono_Celular])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Traslado', $this->Traslado])
            ->andFilterWhere(['like', 'Promotor', $this->Promotor])
            ->andFilterWhere(['like', 'Local', $this->Local])
            ->andFilterWhere(['like', 'Observacion', $this->Observacion])
            ->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }

    public function searchCargo($params)
    {
        $model = new Usuario();

        $CodigoRol = Yii::$app->user->identity->Codigo_Rol;
        $CodigoUsuario = Yii::$app->user->identity->id;

        $where = new Expression($model->getSubFiltros($CodigoRol,$CodigoUsuario));
        $query = Cliente::find()->where($where)->orderBy(['Fecha_Creado' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {

            return $dataProvider;
        }

        $query->andFilterWhere([
            'Codigo_Cliente' => $this->Codigo_Cliente,
            'Edad' => $this->Edad,
            'Tarjeta_De_Credito' => $this->Tarjeta_De_Credito,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificado' => $this->Fecha_Modificado,
            'Fecha_Eliminado' => $this->Fecha_Eliminado,
            'Usuario_Creado' => $this->Usuario_Creado,
            'Usuario_Modificado' => $this->Usuario_Modificado,
            'Usuario_Eliminado' => $this->Usuario_Eliminado,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Apellido', $this->Apellido])
            ->andFilterWhere(['like', 'Profesion', $this->Profesion])
            ->andFilterWhere(['like', 'Estado_Civil', $this->Estado_Civil])
            ->andFilterWhere(['like', 'Distrito', $this->Distrito])
            ->andFilterWhere(['like', 'Direccion', $this->Direccion])
            ->andFilterWhere(['like', 'Telefono_Casa', $this->Telefono_Casa])
            ->andFilterWhere(['like', 'Telefono_Celular', $this->Telefono_Celular])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Traslado', $this->Traslado])
            ->andFilterWhere(['like', 'Promotor', $this->Promotor])
            ->andFilterWhere(['like', 'Local', $this->Local])
            ->andFilterWhere(['like', 'Observacion', $this->Observacion])
            ->andFilterWhere(['like', 'Estado', $this->Estado]);

        return $dataProvider;
    }
}

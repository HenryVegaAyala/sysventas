<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;
use yii\db\Expression;

/**
 * UsuarioSearch represents the model behind the search form about `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    public function rules()
    {
        return [
            [['id', 'confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'last_login_at', 'status', 'Codigo_Rol'], 'integer'],
            [['username', 'email', 'password_hash', 'auth_key', 'unconfirmed_email', 'registration_ip', 'password_reset_token', 'Fecha_Creado', 'Fecha_Modificada', 'Fecha_Eliminada', 'Usuario_Creado', 'Usuario_Modificado', 'Usuario_Eliminado', 'Ultima_Sesion'], 'safe'],
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
        $where = new Expression($model->getFiltros(Yii::$app->user->identity->Codigo_Rol));
//
        $query = Usuario::find()->where($where);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'confirmed_at' => $this->confirmed_at,
            'blocked_at' => $this->blocked_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'flags' => $this->flags,
            'last_login_at' => $this->last_login_at,
            'status' => $this->status,
            'Fecha_Creado' => $this->Fecha_Creado,
            'Fecha_Modificada' => $this->Fecha_Modificada,
            'Fecha_Eliminada' => $this->Fecha_Eliminada,
            'Ultima_Sesion' => $this->Ultima_Sesion,
            'Codigo_Rol' => $this->Codigo_Rol,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'unconfirmed_email', $this->unconfirmed_email])
            ->andFilterWhere(['like', 'registration_ip', $this->registration_ip])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'Usuario_Creado', $this->Usuario_Creado])
            ->andFilterWhere(['like', 'Usuario_Modificado', $this->Usuario_Modificado])
            ->andFilterWhere(['like', 'Usuario_Eliminado', $this->Usuario_Eliminado]);

        return $dataProvider;
    }
}

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->Codigo_Usuario;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Codigo_Usuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Codigo_Usuario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Codigo_Usuario',
            'Nombre',
            'Apellido',
            'Email:email',
            'Contrasena',
            'AuthKey',
            'AccessToken',
            'Activate',
            'Fecha_Creado',
            'Fecha_Modificada',
            'Fecha_Eliminada',
            'Ultima_Sesion',
            'Estado',
            'Codigo_Rol',
        ],
    ]) ?>

</div>

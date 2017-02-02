<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = $model->Codigo_Cliente;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Codigo_Cliente], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Codigo_Cliente], [
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
            'Codigo_Cliente',
            'Nombre',
            'Apellido',
            'Profesion',
            'Edad',
            'Estado_Civil',
            'Distrito',
            'Direccion',
            'Telefono_Casa',
            'Telefono_Celular',
            'Email:email',
            'Traslado',
            'Tarjeta_De_Credito',
            'Promotor',
            'Local',
            'Observacion',
            'Fecha_Creado',
            'Fecha_Modificado',
            'Fecha_Eliminado',
            'Usuario_Creado',
            'Usuario_Modificado',
            'Usuario_Eliminado',
            'Estado',
        ],
    ]) ?>

</div>

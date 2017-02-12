<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AsigTlmkCliente */

$this->title = $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Asig Tlmk Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asig-tlmk-cliente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->codigo], [
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
            'codigo',
            'Codigo_telemarketing',
            'Codigo_Cliente',
            'Fecha_Creada',
            'Fecha_Modificada',
            'Fecha_Eliminada',
            'Usuario_Creado',
            'Usuario_Modificado',
            'Usuario_Eliminado',
            'Fecha_Llamado',
            'Estado',
            'fecha_asignacion_codigo',
        ],
    ]) ?>

</div>

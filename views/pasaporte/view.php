<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pasaporte */

$this->title = $model->Codigo_pasaporte;
$this->params['breadcrumbs'][] = ['label' => 'Pasaportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasaporte-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Codigo_pasaporte], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Codigo_pasaporte], [
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
            'Codigo_pasaporte',
            'Nombre',
            'Stock',
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

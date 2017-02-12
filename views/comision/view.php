<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comision */

$this->title = $model->Codigo;
$this->params['breadcrumbs'][] = ['label' => 'Comisions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comision-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Codigo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Codigo], [
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
            'Codigo',
            'Nombre',
            'monto',
            'porcentaje',
            'Fecha_Creado',
            'Fecha_Modificado',
            'Usuario_Creado',
            'Usuario_Modificado',
            'Estado',
            'codigo_anfitrion',
            'codigo_supervisor_anfitrion',
            'codigo_jefe_anfitrion',
            'no_access_closer',
            'no_access_liner',
        ],
    ]) ?>

</div>

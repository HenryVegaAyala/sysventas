<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = 'Actualización de datos del cliente: ' . $model->Nombre .' '. $model->Apellido;
$this->params['breadcrumbs'][] = ['label' => 'Cliente', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar Cliente';
?>
<div class="cliente-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

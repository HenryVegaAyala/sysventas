<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */

$this->title = 'Actualizar Venta: ' . $model->Codigo_venta;
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Codigo_venta, 'url' => ['view', 'id' => $model->Codigo_venta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="venta-update">

    <?= $this->render('_update', [
        'model' => $model,
        'cliente' => $cliente,
        'certificado' => $certificado,
        'incentivos' => $incentivos,
        'pago' => $pago,
        'formaPago' => $formaPago,
    ]) ?>

</div>

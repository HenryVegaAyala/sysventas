<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FormasPago */

$this->title = 'Update Formas Pago: ' . $model->Codigo_TipoPago;
$this->params['breadcrumbs'][] = ['label' => 'Formas Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Codigo_TipoPago, 'url' => ['view', 'id' => $model->Codigo_TipoPago]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="formas-pago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

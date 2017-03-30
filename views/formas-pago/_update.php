<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\Url;
use synatree\dynamicrelations\DynamicRelations;

/* @var $this yii\web\View */
/* @var $model app\models\FormasPago */
/* @var $form yii\widgets\ActiveForm */

$uniq = uniqid();

if ($model->primaryKey) {

    $removeAttr = 'data-dynamic-relation-remove-route="' . Url::toRoute(['delete', 'id' => $model->primaryKey]) . '"';
    $frag = "FormasPago[new][".rand(1,9999999999)."]";
} else {
    $removeAttr = "";
    $frag = "FormasPago[new][".rand(1,9999999999)."]";
}
?>

<div class="FormasPago-form" <?= $removeAttr; ?>

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-3">
            <?= Html::input('date', $frag . '[fecha_pago]', $model->fecha_pago, ['id' => 'FormasPago-fecha_pago', 'class' => 'form-control', 'dateFormat' => 'Y-m-d','readonly' => 'true']) ?>
        </div>

        <div class="col-sm-3">
            <?= Html::input('text', $frag . '[monto]', $model->monto, ['id' => 'FormasPago-monto', 'class' => 'form-control', 'placeholder' => 'Ingrese el Monto','readonly' => 'true']) ?>
        </div>

        <div class="col-sm-3">
            <?= Html::dropDownList($frag . '[form_pago]', $model->form_pago, $model->getFormaPagos(), ["id" => "FormasPago-form_pago", 'class' => 'form-control', 'prompt' => 'Seleccionar Pago','disabled' => 'disabled']) ?>
        </div>

        <div class="col-sm-3">
            <?= Html::dropDownList($frag . '[Estado_Pago]', $model->Estado_Pago, $model->getEstadoPagos(), ["id" => "FormasPago-Estado_Pago", 'class' => 'form-control', 'prompt' => 'Seleccionar Estado','disabled' => 'disabled']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <?= Html::input('text', $frag . '[num_serie]', $model->num_serie, ['id' => 'FormasPago-num_serie', 'class' => 'form-control', 'placeholder' => 'N° de Serie','readonly' => 'true']) ?>
        </div>

        <div class="col-sm-3">
            <?= Html::input('text', $frag . '[comprobante]', $model->comprobante, ['id' => 'FormasPago-comprobante', 'class' => 'form-control', 'placeholder' => 'N° de Comprobante','readonly' => 'true']) ?>
        </div>

        <div class="col-sm-3">
            <?= Html::input('text', $frag . '[raz_social]', $model->raz_social, ['id' => 'FormasPago-raz_social', 'class' => 'form-control', 'placeholder' => 'N° de Razón Social','readonly' => 'true']) ?>
        </div>
    </div>
</div>
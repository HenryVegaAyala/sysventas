<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\FormasPago */
/* @var $form yii\widgets\ActiveForm */

$uniq = uniqid();

if ($model->primaryKey) {

    $removeAttr = 'data-dynamic-relation-remove-route="' . Url::toRoute(['delete', 'id' => $model->primaryKey]) . '"';
    $frag = "FormasPago[{$model->primaryKey}]";
} else {
    $removeAttr = "";
    $frag = "FormasPago[new][$uniq]";
}
?>

<div class="FormasPago-form" <?= $removeAttr; ?>

<div class="row">

    <div class="col-sm-3">
        <?= Html::input('date', $frag . '[fecha_pago]', $model->fecha_pago, ['id' => 'FormasPago-fecha_pago', 'class' => 'form-control', 'dateFormat' => 'Y-m-d']) ?>
    </div>

    <div class="col-sm-3">
        <?= Html::input('text', $frag . '[monto]', $model->monto, ['id' => 'FormasPago-monto', 'class' => 'form-control', 'placeholder' => 'Ingrese el Monto']) ?>
    </div>

    <div class="col-sm-3">
        <?= Html::dropDownList($frag . '[form_pago]', $model->form_pago, $model->getFormaPagos(), ["id" => "FormasPago-form_pago", 'class' => 'form-control', 'prompt' => 'Seleccionar Pago']) ?>
    </div>

    <div class="col-sm-3">
        <?= Html::input('text', $frag . '[num_serie]', $model->num_serie, ['id' => 'FormasPago-num_serie', 'class' => 'form-control', 'placeholder' => 'N° de Serie']) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <?= Html::input('text', $frag . '[comprobante]', $model->comprobante, ['id' => 'FormasPago-comprobante', 'class' => 'form-control', 'placeholder' => 'N° de Comprobante']) ?>
    </div>

    <div class="col-sm-3">
        <?= Html::input('text', $frag . '[raz_social]', $model->raz_social, ['id' => 'FormasPago-raz_social', 'class' => 'form-control', 'placeholder' => 'N° de Razón Social']) ?>
    </div>
</div>
</div>
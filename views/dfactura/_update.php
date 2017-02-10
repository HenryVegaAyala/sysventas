<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use \kartik\widgets\Select2;
use synatree\dynamicrelations\DynamicRelations;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var app\models\DFactura $model
 * @var yii\widgets\ActiveForm $form
 */
$uniq = uniqid();

if ($model->primaryKey) {

    $removeAttr = 'data-dynamic-relation-remove-route="' . Url::toRoute(['delete', 'id' => $model->primaryKey]) . '"';
    $frag = "Dfactura[new][".rand(1,9999999999)."]";
} else {
    $removeAttr = "";
    $frag = "Dfactura[new][".rand(1,9999999999)."]";
}
?>

<div class="dfactura-form" <?= $removeAttr; ?> >

    <div class="row">

        <div class="col-sm-2">
            <div class="form-group field-dfactura-Cantidad">
                <?= Html::input('text', $frag . '[Cantidad]', $model->Cantidad, ['id' => 'dfactura-cantidad', 'class' => 'form-control', 'placeholder' => 'Cantidad']) ?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group field-dfactura-producto">
                <?= Html::input('text', $frag . '[Descripcion]', $model->Descripcion, ['id' => 'dfactura-Descripcion', 'class' => 'form-control', 'placeholder' => 'Contenido']) ?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group field-dfactura-precio">
                <?= Html::input('text', $frag . '[precio]', $model->precio, ['id' => 'dfactura-precio', 'class' => 'form-control', 'placeholder' => 'Precio']) ?>
                <div class="help-block"></div>
            </div>

        </div>

        <div class="col-sm-2">
            <div class="form-group field-dfactura-Total">
                <?= Html::input('text', $frag . '[Total]', $model->Total, ['id' => 'dfactura-Total', 'class' => 'form-control', 'readonly' => 'true', 'placeholder' => 'Total']) ?>
                <div class="help-block"></div>
            </div>
        </div>

    </div>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use app\models\FechaAsignacion;

/* @var $this yii\web\View */
/* @var $model app\models\AsigTlmkCliente */
/* @var $form yii\widgets\ActiveForm */
$uniq = uniqid();

if ($model->primaryKey) {

    $removeAttr = 'data-dynamic-relation-remove-route="' . Url::toRoute(['delete', 'id' => $model->primaryKey]) . '"';
    $frag = "AsigTlmkCliente[{$model->primaryKey}]";
} else {
    $removeAttr = "";
    $frag = "AsigTlmkCliente[new][$uniq]";
}
?>

<div class="asig-tlmk-cliente-form" <?= $removeAttr; ?> >

    <div class="row">

        <div class="col-sm-6">
            <div class="form-group field-beneficiario-Codigo_telemarketing">
                <?= Html::dropDownList($frag . '[Codigo_Cliente]', $model->Codigo_telemarketing, $model->getTelemarking(), ["id" => "Beneficiario-Estado_Civil", 'class' => 'form-control', 'prompt' => 'Seleccionar Beneficiario']) ?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group field-beneficiario-Codigo_Cliente">
                <?= Html::input('text', $frag . '[Codigo_Cliente]', $model->Codigo_Cliente, ['id' => 'Beneficiario-Codigo_Cliente', 'class' => 'form-control']) ?>
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>

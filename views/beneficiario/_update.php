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
 * @var app\models\Beneficiario $model
 * @var yii\widgets\ActiveForm $form
 */
$uniq = uniqid();

if ($model->primaryKey) {

    $removeAttr = 'data-dynamic-relation-remove-route="' . Url::toRoute(['delete', 'id' => $model->primaryKey]) . '"';
    $frag = "Beneficiario[new][".rand(1,9999999999)."]";
} else {
    $removeAttr = "";
    $frag = "Beneficiario[new][".rand(1,9999999999)."]";
}
?>

<div class="beneficiario-form" <?= $removeAttr; ?> >

    <div class="row">

        <div class="col-sm-5">
            <div class="form-group field-beneficiario-Nombre">
                <label class="control-label" for="cliente-nombre">Nombres</label>
                <?= Html::input('text', $frag . '[Nombre]', $model->Nombre, ['id' => 'Beneficiario-Nombre', 'class' => 'form-control']) ?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-sm-5">
            <label class="control-label" for="cliente-nombre">Apellidos</label>
            <div class="form-group field-beneficiario-Apellido">
                <?= Html::input('text', $frag . '[Apellido]', $model->Apellido, ['id' => 'Beneficiario-Apellido', 'class' => 'form-control']) ?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-sm-2">
            <label class="control-label" for="cliente-nombre">Edad</label>
            <div class="form-group field-beneficiario-Edad">
                <?= Html::input('text', $frag . '[Edad]', $model->Edad, ['id' => 'Beneficiario-Edad', 'class' => 'form-control']) ?>
                <div class="help-block"></div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-3">
            <label class="control-label" for="cliente-Email">Email</label>
            <div class="form-group field-beneficiario-Email">
                <?= Html::input('text', $frag . '[Email]', $model->Email, ['id' => 'Beneficiario-Email', 'class' => 'form-control']) ?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-sm-3">
            <label class="control-label" for="cliente-Email">Teléfono de Casa</label>
            <div class="form-group field-beneficiario-Telefono_Casa">
                <?= Html::input('text', $frag . '[Telefono_Casa]', $model->Telefono_Casa, ['id' => 'Beneficiario-Telefono_Casa', 'class' => 'form-control']) ?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-sm-3">
            <label class="control-label" for="cliente-Email">Teléfono Celular</label>
            <div class="form-group field-beneficiario-Telefono_Celular">
                <?= Html::input('text', $frag . '[Telefono_Celular]', $model->Telefono_Celular, ['id' => 'Beneficiario-Telefono_Celular', 'class' => 'form-control']) ?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-sm-3">
            <label class="control-label" for="cliente-Email">Tipo de Beneficiario</label>
            <div class="form-group field-beneficiario-Estado_Civil">
                <?= Html::dropDownList($frag . '[Estado_Civil]', $model->Estado_Civil, $model->getEstadoCivil(), ["id" => "Beneficiario-Estado_Civil", 'class' => 'form-control', 'prompt' => 'Seleccionar Beneficiario']) ?>
            </div>
        </div>
    </div>

</div>

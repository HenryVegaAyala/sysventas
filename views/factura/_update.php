<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use app\models\Cliente;
use synatree\dynamicrelations\DynamicRelations;
use yii\helpers\Url;

use app\models\DFactura;
use app\models\DFacturaSearch;

/**
 * @var yii\web\View $this
 * @var app\models\Factura $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <?php $form = ActiveForm::begin(); ?>
    <div class="fieldset">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'id')->textInput(['maxlength' => true, 'readonly' => true,'value' => $model->id]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'Codigo_Cliente')->textInput(['maxlength' => true, 'readonly' => true, 'value' => $model->NombreCliente($model->Codigo_Cliente)]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'Codigo_Combo')->dropDownList($model->getPasaporte(), ['prompt' => 'Seleccione un Pasaporte', 'class' => 'form-control loginmodal-container-combo', 'disabled' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= DynamicRelations::widget([
                        'title' => 'Productos Adicionales:',
                        'collection' => $model->dFacturas,
                        'viewPath' => '@app/views/dfactura/_update.php',
                        'collectionType' => new \app\models\dfactura,

                    ]); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <?= Html::submitButton($model->isNewRecord ? "Guardar" : "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar", ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
        <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['index'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\Autocomplete;
use app\models\Cliente;
use app\models\Beneficiario;
use app\models\Certificado;
use app\models\Comision;
use app\models\Combo;
use synatree\dynamicrelations\DynamicRelations;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */
/* @var $cliente app\models\Cliente */
/* @var $certificado app\models\Certificado */
/* @var $incentivos app\models\Combo */
/* @var $pago app\models\Pago */
/* @var $formaPago app\models\FormasPago */
/* @var $comision app\models\Comision */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default" xmlns="http://www.w3.org/1999/html">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <br>

    <?php $form = ActiveForm::begin(); ?>

    <div class="container-fluid" id="Busqueda">
        <div class="row">
            <div class="col-sm-5">
                <?= $form->field($model, 'uso_interno')->widget(\yii\jui\AutoComplete::classname(), [
                    'options' => [
                        'class' => 'form-control',
                        'onkeyup' => 'validar(this.value)'

                    ],
                    'clientOptions' => [
                        'source' => $model->getCliente(),
                    ],
                ])
                ?>
            </div>
            <div class="col-sm-3">
                <label style="color: transparent">boton</label>
                <br>
                <?= Html::button('<i class="fa fa-search" aria-hidden="true"></i> Buscar Cliente', ['id' => 'btnbusqueda', 'class' => 'btn btn-success', 'href' => 'javascript:;', 'onclick' => "busqueda($('#venta-uso_interno').val());return false;", 'disabled' => true]) ?>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="Ncontrato" style="display: none;">
        <div class="row">
            <div class="col-sm-3" style="float: right ">
                <?= $form->field($model, 'numero_comprobante')->textInput(['placeholder' => "N° de Comprobante", 'maxlength' => 12])->label(false) ?>
            </div>
            <div class="col-sm-2" style="float: right ">
                <?= $form->field($model, 'serie_comprobante')->textInput(['placeholder' => "N° de Serie", 'maxlength' => 12])->label(false) ?>
            </div>
            <div class="col-sm-3" style="float: right ">
                <?= $form->field($model, 'numero_contrato')->textInput(['autofocus' => 'autofocus', 'placeholder' => "N° de Contrato", 'maxlength' => 12])->label(false) ?>
            </div>
        </div>
    </div>

    <fieldset id="ResultadoCliente" style="display: none;">
        <legend style="padding-left:5px ">Datos del Cliente:</legend>
        <div class="container-fluid">
            <div class="row">
                <div style="display: none">
                    <?= $form->field($cliente, 'Codigo_Cliente')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($cliente, 'Nombre')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($cliente, 'Apellido')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($cliente, 'dni')->textInput(['maxlength' => 8]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($cliente, 'Edad')->textInput(['maxlength' => 2]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Direccion')->textInput() ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($cliente, 'Distrito')->widget(\yii\jui\AutoComplete::classname(), [
                        'options' => [
                            'class' => 'form-control',
                        ],
                        'clientOptions' => [
                            'source' => $cliente->getDistrito(),
                        ],
                    ]) ?>
                </div>

                <div class="col-sm-3">
                    <?= $form->field($cliente, 'Traslado')->dropDownList($cliente->getTraslado(), ['prompt' => 'Seleccionar tipo de Traslado', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Tarjeta_De_Credito')->dropDownList($cliente->getTarjeta(), ['prompt' => 'Seleccione una Tarjeta', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Estado_Civil')->dropDownList($cliente->getEstadoCivil(), ['prompt' => 'Seleccione un Estado  Civil', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Profesion')->widget(\yii\jui\AutoComplete::classname(), [
                        'options' => [
                            'class' => 'form-control',
                        ],
                        'clientOptions' => [
                            'source' => $cliente->getCarrera(),
                        ],
                    ]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Telefono_Casa')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Telefono_Casa2')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Telefono_Celular')->textInput(['maxlength' => true]) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Telefono_Celular2')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Telefono_Celular3')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Email')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?= DynamicRelations::widget([
                        'title' => 'Beneficiarios:',
                        'collection' => $cliente->beneficiarios,
                        'viewPath' => '@app/views/beneficiario/_form.php',
                        'collectionType' => new \app\models\Beneficiario(),

                    ]); ?>
                </div>
            </div>

        </div>
    </fieldset>

    <fieldset id="ProductoContratado" style="display: none;"
    ">
    <legend style="padding-left:5px ">Producto Contratado:</legend>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <?= $form->field($model, 'Codigo_club')->dropDownList($model->getClub(), ['prompt' => 'Seleccione un Club', 'class' => 'form-control loginmodal-container-combo', 'onchange' => 'Cantidad(this.value);']) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'Codigo_pasaporte')->dropDownList($model->getPasaporte(), ['prompt' => 'Seleccione un Pasaporte', 'class' => 'form-control loginmodal-container-combo']) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'numero_pasaporte')->textInput(['maxlength' => 9, 'onkeyup' => "ValidarPasaporte($('#venta-codigo_pasaporte').val(),this.value);return false;"]) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label" for="venta-numero_pasaporte">Resulado de la Búsqueda</label>
                <br>
                <span id="query" class="text-success"></span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($certificado, 'codigo_barra')->textInput(['maxlength' => 9]) ?>
            </div>
            <div class="col-sm-1">
                <label style="color: transparent">boton</label>
                <br>
                <?= Html::button('<i class="fa fa-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success', 'href' => 'javascript:;', 'onclick' => "IngresarCertificado($('#certificado-codigo_barra').val(),$('#venta-numero_total').val(),$('#venta-numero_pasaporte').val());return false;"]) ?>
            </div>

            <div class="col-sm-3">
                <label class="control-label" for="venta-numero_pasaporte">Resulado de la Búsqueda</label>
                <br>
                <span id="query2"></span>
            </div>

            <div class="col-sm-1">
                <?= $form->field($model, 'numero_escaneado')->textInput(['maxlength' => 2, 'readonly' => 'true', 'value' => '0']) ?>
            </div>
            <div class="col-sm-1">
                <label style="color: transparent">boton</label>
                <?= Html::button('<i class="fa fa-arrow-up" aria-hidden="true"></i>', ['id'=>'btnScan','class' => 'btn btn-success', 'href' => 'javascript:;', 'onclick' => "contador($('#venta-numero_pasaporte').val());return false;", 'onmousedown' => "escaneado($('#venta-numero_pasaporte').val());return false;"]) ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'numero_total')->textInput(['maxlength' => 2, 'readonly' => 'true']) ?>
            </div>

        </div>
        <fieldset>
            <legend>Lista de Certificados:</legend>
            <h4 id="Grilla"></h4>
        </fieldset>
    </div>
    </fieldset>

    <fieldset id="Inventivos" style="display: none;">
        <legend style="padding-left:5px ">Incentivos:</legend>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($incentivos, 'convetidor1')->textInput(['maxlength' => 250]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($incentivos, 'convetidor2')->textInput(['maxlength' => 255]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($incentivos, 'Regalos')->textInput(['maxlength' => 255]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($incentivos, 'Observacion')->textarea(['maxlength' => 250]) ?>
                </div>
            </div>

        </div>
    </fieldset>

    <fieldset id="FormaPago" style="display: none;">
        <legend style="padding-left:5px ">Forma de Pago:</legend>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($pago, 'tipo_pago')->dropDownList($model->getMedioDePago(), ['prompt' => 'Seleccione un Medio de Pago', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($pago, 'estado_pago')->dropDownList($model->getEstadoDePago(), ['prompt' => 'Seleccione un Estado de Pago', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'montoTotal')->textInput(['maxlength' => 255, 'readonly' => 'true']) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($pago, 'monto_ingresado')->textInput(['maxlength' => 255, 'onkeyup' => "resta($('#venta-montototal').val(),this.value);return false;"]) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($pago, 'monto_restante')->textInput(['maxlength' => 255, 'readonly' => 'true']) ?>
                </div>
            </div>

            <label class="form-control">Fechas de Pago:</label>

            <div class="row">
                <div class="col-sm-6">
                    <?= Html::button('<i class="fa fa-plus" aria-hidden="true"></i> Agregar Fechas de Pago', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <?php
                    echo $form->field($formaPago, 'fecha_pago')->widget(\kartik\widgets\DatePicker::classname(), [
                        'options' => ['placeholder' => 'Fecha'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]);?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($formaPago, 'monto')->textInput(['maxlength' => 8]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'restante')->textInput(['maxlength' => 8]) ?>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset id="Comisiones" style="display: none;">
        <legend style="padding-left:5px ">Comisiones:</legend>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision1')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision2')->textInput(['maxlength' => 250]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision3')->textInput(['maxlength' => 250]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision4')->textInput(['maxlength' => 250]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision5')->textInput(['maxlength' => 250]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision6')->textInput(['maxlength' => 250]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision7')->textInput(['maxlength' => 250]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision8')->textInput(['maxlength' => 250]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision9')->textInput(['maxlength' => 250]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision10')->textInput(['maxlength' => 250]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision11')->textInput(['maxlength' => 250]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision12')->textInput(['maxlength' => 250]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($model, 'codigo_comision13')->textInput(['maxlength' => 250]) ?>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset id="Selectsalas" style="display: none;">
        <legend style="padding-left:5px ">Salas:</legend>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'salas')->dropDownList($model->getSalas(), ['prompt' => 'Seleccione un Sala', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
            </div>
        </div>
    </fieldset>


    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12" id="btnBotones" style="display: none">
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>

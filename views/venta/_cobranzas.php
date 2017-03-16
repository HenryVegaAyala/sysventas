<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\Autocomplete;
use app\models\Cliente;
use app\models\Beneficiario;
use app\models\Certificado;
use app\models\Comision;
use app\models\Combo;
use app\models\Cotitular;
use synatree\dynamicrelations\DynamicRelations;
use yii\helpers\Url;
use yii\db\Query;
use yii\db\Expression;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */
/* @var $cliente app\models\Cliente */
/* @var $certificado app\models\Certificado */
/* @var $incentivos app\models\Combo */
/* @var $pago app\models\Pago */
/* @var $formaPago app\models\FormasPago */
/* @var $comision app\models\Comision */
/* @var $cotitular app\models\Cotitular */
/* @var $form yii\widgets\ActiveForm */

$certificado = new Certificado();
?>

<div class="panel panel-default" xmlns="http://www.w3.org/1999/html">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <br>
    <?php Pjax::begin() ?>
    <?php $form = ActiveForm::begin([
        'id' => 'venta-form',
        'enableAjaxValidation' => false,
        'options' => ['data-pjax' => true],
        'enableClientValidation' => true
    ]); ?>


    <div class="container-fluid" id="Ncontrato">
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'salas')->dropDownList($model->getSalas(), ['prompt' => 'Seleccione un Sala', 'class' => 'form-control loginmodal-container-combo', 'onchange' => "pasaporteCodigo($('#venta-salas').val());return false;",'disabled' => 'true']) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'numero_contrato')->textInput(['placeholder' => "N° de Contrato", 'maxlength' => 12, 'readonly' => 'true']) ?>
            </div>
        </div>
    </div>

    <fieldset id="ResultadoCliente">
        <legend style="padding-left:5px ">Datos del Cliente:</legend>
        <div class="container-fluid">
            <div class="row">
                <div style="display: none">
                    <?= $form->field($cliente, 'Codigo_Cliente')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($cliente, 'Nombre')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($cliente, 'Apellido')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($cliente, 'dni')->textInput(['maxlength' => 15, 'readonly' => 'true']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($cliente, 'Edad')->textInput(['maxlength' => 2, 'readonly' => 'true']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Direccion')->textInput(['readonly' => 'true']) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($cliente, 'Distrito')->widget(\yii\jui\AutoComplete::classname(), [
                        'options' => [
                            'class' => 'form-control',
                            'readonly' => 'true'
                        ],
                        'clientOptions' => [
                            'source' => $cliente->getDistrito(),
                        ],
                    ]) ?>
                </div>

                <div class="col-sm-3">
                    <?= $form->field($cliente, 'Traslado')->dropDownList($cliente->getTraslado(), ['prompt' => 'Seleccionar tipo de Traslado', 'class' => 'form-control loginmodal-container-combo','disabled' => 'true']) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Tarjeta_De_Credito')->dropDownList($cliente->getTarjeta(), ['prompt' => 'Seleccione una Tarjeta', 'class' => 'form-control loginmodal-container-combo','disabled' => 'true']) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Estado_Civil')->dropDownList($cliente->getEstadoCivil(), ['prompt' => 'Seleccione un Estado  Civil', 'class' => 'form-control loginmodal-container-combo','disabled' => 'true']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Profesion')->widget(\yii\jui\AutoComplete::classname(), [
                        'options' => [
                            'class' => 'form-control', 'readonly' => 'true'
                        ],
                        'clientOptions' => [
                            'source' => $cliente->getCarrera(),
                        ],
                    ]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Telefono_Casa')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Telefono_Casa2')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Telefono_Celular')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Telefono_Celular2')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Telefono_Celular3')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($cliente, 'Email')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>
            </div>

            <fieldset id="cotitular">
                <legend style="padding-left:5px ">Datos del Co-Titular:</legend>
                <div class="container-fluid">
                    <div class="row">
                        <div style="display: none">
                            <?= $form->field($cotitular, 'Codigo_Cliente')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                        </div>
                        <div class="col-sm-5">
                            <?= $form->field($cotitular, 'Nombre')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                        </div>
                        <div class="col-sm-5">
                            <?= $form->field($cotitular, 'Apellido')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $form->field($cotitular, 'dni')->textInput(['maxlength' => 15, 'readonly' => 'true']) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <?= $form->field($cotitular, 'Edad')->textInput(['maxlength' => 2, 'readonly' => 'true']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Direccion')->textInput(['readonly' => 'true']) ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($cotitular, 'Distrito')->widget(\yii\jui\AutoComplete::classname(), [
                                'options' => [
                                    'class' => 'form-control', 'readonly' => 'true'
                                ],
                                'clientOptions' => [
                                    'source' => $cliente->getDistrito(),
                                ],
                            ]) ?>
                        </div>

                        <div class="col-sm-3">
                            <?= $form->field($cotitular, 'Traslado')->dropDownList($cliente->getTraslado(), ['prompt' => 'Seleccionar tipo de Traslado', 'class' => 'form-control loginmodal-container-combo','disabled' => 'true']) ?>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Tarjeta_De_Credito')->dropDownList($cliente->getTarjeta(), ['prompt' => 'Seleccione una Tarjeta', 'class' => 'form-control loginmodal-container-combo','disabled' => 'true']) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Estado_Civil')->dropDownList($cliente->getEstadoCivil(), ['prompt' => 'Seleccione un Estado  Civil', 'class' => 'form-control loginmodal-container-combo','disabled' => 'true']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Profesion')->widget(\yii\jui\AutoComplete::classname(), [
                                'options' => [
                                    'class' => 'form-control', 'readonly' => 'true'
                                ],
                                'clientOptions' => [
                                    'source' => $cliente->getCarrera(),
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Telefono_Casa')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Telefono_Casa2')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Telefono_Celular')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Telefono_Celular2')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Telefono_Celular3')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Email')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                        </div>
                    </div>

                </div>
            </fieldset>

            <div class="row">
                <div class="col-sm-12">

                    <label class="form-control">Beneficiarios:</label>
                    <ul class="list-group">

                        <li class="list-group-item">
                            <a href="" class="btn btn-success btn-sm"  disabled="true">
                                <i class="glyphicon glyphicon-plus"></i> Agregar
                            </a>
                        </li>

                    </ul>

                </div>
            </div>

        </div>
    </fieldset>

    <fieldset id="ProductoContratado">
        <legend style="padding-left:5px ">Producto Contratado:</legend>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'Codigo_club')->dropDownList($model->getClub(), ['prompt' => 'Seleccione un Club', 'class' => 'form-control loginmodal-container-combo', 'onchange' => 'Cantidad(this.value);','disabled' => 'true']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'numero_pasaporte')->textInput(['maxlength' => 9, 'readonly' => 'true']) ?>
                    <!-- ValidarPasaporte($('#venta-codigo_pasaporte').val(),this.value);return false; -->
                </div>
                <div class="col-sm-4">
                    <?= $form->field($certificado, 'codigo_barra')->textInput(['maxlength' => 9, 'onkeyup' => "jsAgregar(event,this.value,$('#venta-codigo_club').val(),$('#venta-numero_pasaporte').val());", 'readonly' => 'true']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label class="control-label" for="venta-numero_pasaporte">Resulado de la Búsqueda</label>
                    <br>
                    <span id="queryRest" class="text-success"></span>
                </div>

                <div class="col-sm-2">
                    <label style="color: transparent">boton</label>
                    <br>
                    <?= Html::button('Cargar Certificado', ['id' => 'btnScan', 'class' => 'btn btn-success', 'href' => 'javascript:;', 'onclick' => "contador($('#venta-numero_pasaporte').val(),$('#certificado-codigo_barra').val());contadorescaneado($('#venta-numero_pasaporte').val());",'disabled' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'numero_escaneado')->textInput(['maxlength' => 2, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'numero_total')->textInput(['maxlength' => 2, 'readonly' => 'true']) ?>
                </div>

            </div>
            <fieldset>

                <div>
                    <legend>Lista de Certificados:</legend>
                    <h4 id="Grilla"></h4>
                </div>

                <div>
                    <h4>
                        <?php
                        $connection = Yii::$app->db;
                        $sqlStatement = "SELECT codigo_barra FROM certificado WHERE Codigo_pasaporte = '" . $model->NumeroPasaporte($model->Codigo_venta, 1) . "'";
                        $comando = $connection->createCommand($sqlStatement);
                        $resultado = $comando->query();
                        while ($row = $resultado->read()) {
                            echo $row['codigo_barra'];
                            echo " - ";
                        }
                        ?>
                    </h4>
                </div>
            </fieldset>
        </div>
    </fieldset>

    <fieldset id="Inventivos">
        <legend style="padding-left:5px ">Incentivos:</legend>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($incentivos, 'convetidor1')->textInput(['maxlength' => 250, 'readonly' => 'true']) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($incentivos, 'convetidor2')->textInput(['maxlength' => 255, 'readonly' => 'true']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($incentivos, 'Regalos')->textInput(['maxlength' => 255, 'readonly' => 'true']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($incentivos, 'Observacion')->textarea(['maxlength' => 250, 'readonly' => 'true']) ?>
                </div>
            </div>

        </div>
    </fieldset>

    <fieldset id="FormaPago">
        <legend style="padding-left:5px ">Forma de Pago:</legend>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($pago, 'tipo_pago')->dropDownList($model->getMedioDePago(), ['prompt' => 'Seleccione un Medio de Pago', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($pago, 'estado_pago')->dropDownList($model->getEstadoDePago(), ['onchange' => "validador($('#pago-estado_pago').val(),$('#venta-montototal').val(),$('#pago-monto_ingresado').val());return false;", 'prompt' => 'Seleccione un Estado de Pago', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'montoTotal')->textInput(['value' => $model->NumeroPasaporte($model->Codigo_club, 4), 'maxlength' => 255, 'readonly' => 'true']) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($pago, 'monto_ingresado')->textInput(['maxlength' => 255, 'onkeyup' => "resta($('#venta-montototal').val(),this.value);return false;"]) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($pago, 'monto_restante')->textInput(['maxlength' => 255, 'readonly' => 'true']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?= DynamicRelations::widget([
                        'title' => 'Formas de Pago:',
                        'collection' => $pago->formasPagos,
                        'viewPath' => '@app/views/formas-pago/_update.php',
                        'collectionType' => new \app\models\FormasPago,

                    ]); ?>
                </div>
            </div>

        </div>
    </fieldset>

    <fieldset id="Comisiones" style="display: none">
        <legend style="padding-left:5px ">Comisiones:</legend>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($comision, 'Digitador')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'OPC')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'Tienda')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'SupervisorPromotor')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'SuperviorGeneralOPC')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'DirectordeMercadero')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($comision, 'TLMK')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'SupervisordeTLMK')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'Confirmadora')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'DirectordeTLMK')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'Liner')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'Closer')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

            </div>
            <div class="row">

                <div class="col-sm-2">
                    <?= $form->field($comision, 'Closer2')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'JefedeSala')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'DirectordeVentas')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'DirectordeProyectos')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'GenerenciaGeneral')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'directordePlaneamiento')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'asesordePlaneamiento')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
                </div>
            </div>
        </div>
    </fieldset>

</div>

<div class="panel-footer container-fluid foo">
    <div class="col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? "Guardar" : "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar", ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ', 'id' => 'btn-form-venta']) ?>
        <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>
</div>

</div>
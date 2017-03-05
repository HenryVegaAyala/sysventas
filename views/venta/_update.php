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

    <?php $form = ActiveForm::begin(); ?>

    <div class="container-fluid" id="Ncontrato">
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'razon_social')->textInput(['autofocus' => 'autofocus', 'placeholder' => "Razon Social", 'maxlength' => 100])->label(false) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'numero_contrato')->textInput(['placeholder' => "N° de Contrato", 'maxlength' => 12])->label(false) ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'serie_comprobante')->textInput(['placeholder' => "N° de Serie", 'maxlength' => 12])->label(false) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'numero_comprobante')->textInput(['placeholder' => "N° de Comprobante", 'maxlength' => 12])->label(false) ?>
            </div>
        </div>
    </div>

    <fieldset id="ResultadoCliente">
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

            <fieldset id="cotitular" >
                <legend style="padding-left:5px ">Datos del Co-Titular:</legend>
                <div class="container-fluid">
                    <div class="row">
                        <div style="display: none">
                            <?= $form->field($cotitular, 'Codigo_Cliente')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-5">
                            <?= $form->field($cotitular, 'Nombre')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-5">
                            <?= $form->field($cotitular, 'Apellido')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $form->field($cotitular, 'dni')->textInput(['maxlength' => 15]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <?= $form->field($cotitular, 'Edad')->textInput(['maxlength' => 2]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Direccion')->textInput() ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($cotitular, 'Distrito')->widget(\yii\jui\AutoComplete::classname(), [
                                'options' => [
                                    'class' => 'form-control',
                                ],
                                'clientOptions' => [
                                    'source' => $cliente->getDistrito(),
                                ],
                            ]) ?>
                        </div>

                        <div class="col-sm-3">
                            <?= $form->field($cotitular, 'Traslado')->dropDownList($cliente->getTraslado(), ['prompt' => 'Seleccionar tipo de Traslado', 'class' => 'form-control loginmodal-container-combo']) ?>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Tarjeta_De_Credito')->dropDownList($cliente->getTarjeta(), ['prompt' => 'Seleccione una Tarjeta', 'class' => 'form-control loginmodal-container-combo']) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Estado_Civil')->dropDownList($cliente->getEstadoCivil(), ['prompt' => 'Seleccione un Estado  Civil', 'class' => 'form-control loginmodal-container-combo']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Profesion')->widget(\yii\jui\AutoComplete::classname(), [
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
                            <?= $form->field($cotitular, 'Telefono_Casa')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Telefono_Casa2')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Telefono_Celular')->textInput(['maxlength' => true]) ?>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Telefono_Celular2')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Telefono_Celular3')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($cotitular, 'Email')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                </div>
            </fieldset>

            <div class="row">
                <div class="col-sm-12">
                    <?= DynamicRelations::widget([
                        'title' => 'Beneficiarios:',
                        'collection' => $cliente->beneficiarios,
                        'viewPath' => '@app/views/beneficiario/_update.php',
                        'collectionType' => new \app\models\Beneficiario(),

                    ]); ?>
                </div>
            </div>

        </div>
    </fieldset>

    <fieldset id="ProductoContratado"
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
                <?= $form->field($model, 'numero_pasaporte')->textInput(['value' => $model->NumeroPasaporte($model->Codigo_venta, 1), 'maxlength' => 9, 'onkeyup' => "ValidarPasaporte($('#venta-codigo_pasaporte').val(),this.value);return false;"]) ?>
            </div>
            <div class="col-sm-3">
                <label class="control-label" for="venta-numero_pasaporte">Resulado de la Búsqueda</label>
                <br>
                <span id="query" class="text-success"></span>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'codigo_barra')->textInput(['maxlength' => 9, 'value' => '']) ?>
            </div>
            <div class="col-sm-1">
                <label style="color: transparent">boton</label>
                <br>
                <?= Html::button('<i class="fa fa-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success', 'href' => 'javascript:;', 'onclick' => "IngresarCertificado($('#certificado-codigo_barra').val(),$('#venta-numero_total').val(),$('#venta-numero_pasaporte').val());return false;"]) ?>
            </div>

            <div class="col-sm-3">
                <label class="control-label" for="venta-numero_pasaporte">Resultado de la Búsqueda</label>
                <br>
                <span id="query2"></span>
            </div>

            <div class="col-sm-1">
                <?= $form->field($model, 'numero_escaneado')->textInput(['value' => $certificado->CantidadCertificado($model->NumeroPasaporte($model->Codigo_venta, 1)), 'maxlength' => 2, 'readonly' => 'true']) ?>
            </div>
            <div class="col-sm-1">
                <label style="color: transparent">boton</label>
                <?= Html::button('<i class="fa fa-arrow-up" aria-hidden="true"></i>', ['id' => 'btnScan', 'class' => 'btn btn-success', 'href' => 'javascript:;', 'onclick' => "contador($('#venta-numero_pasaporte').val());return false;", 'onmousedown' => "escaneado($('#venta-numero_pasaporte').val());return false;"]) ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($model, 'numero_total')->textInput(['value' => $model->NumeroPasaporte($model->Codigo_club, 2), 'maxlength' => 2, 'readonly' => 'true']) ?>
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
                    $sqlStatement = "SELECT codigo_barra FROM certificado WHERE Codigo_pasaporte = '" .$model->NumeroPasaporte($model->Codigo_venta, 1). "'";
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

    <fieldset id="FormaPago">
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
                    <?= $form->field($model, 'montoTotal')->textInput(['value' => $model->NumeroPasaporte($model->Codigo_club, 4),'maxlength' => 255, 'readonly' => 'true']) ?>
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

    <fieldset id="Comisiones">
        <legend style="padding-left:5px ">Comisiones:</legend>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($comision, 'Digitador')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'OPC')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'Tienda')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'SupervisorPromotor')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'SuperviorGeneralOPC')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'DirectordeMercadero')->textInput(['maxlength' => true]) ?>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($comision, 'TLMK')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'SupervisordeTLMK')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'Confirmadora')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'DirectordeTLMK')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'Liner')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'Closer')->textInput(['maxlength' => true]) ?>
                </div>

            </div>
            <div class="row">

                <div class="col-sm-2">
                    <?= $form->field($comision, 'Closer2')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'JefedeSala')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'DirectordeVentas')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'DirectordeProyectos')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'GenerenciaGeneral')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'directordePlaneamiento')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($comision, 'asesordePlaneamiento')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset id="Selectsalas">
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
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "Guardar" : "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar", ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <div class="container-fluid">
        <br>
        <?php

        Modal::begin([
            'options' => [
                'id' => 'kartik-modal',
                'tabindex' => false // important for Select2 to work properly
            ],
            'header' => '<h4 style="text-align: center">Seleccionar Cliente</h4>',
            'toggleButton' => ['label' => '<i class="fa fa-id-card" aria-hidden="true"></i> Actualizar datos del cliente', 'class' => 'btn btn-default'],
        ]);

        $form = ActiveForm::begin(['action' => 'cliente', 'id' => 'forum_post', 'method' => 'post','options'=>['target'=>'_blank']]);

        echo Select2::widget([
            'name' => 'Venta[Codigo_Cliente]',
            'data' => ArrayHelper::map(\app\models\Cliente::find()->all(), 'Codigo_Cliente', 'fullName'),
            'options' => ['placeholder' => 'Seleccionar al cliente'],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],
        ]);
        echo "<br>";
        echo "<center>";
        echo Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-search\" aria-hidden=\"true\"></i> Buscar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']);
        echo "</center>";
        ActiveForm::end();

        Modal::end();
        ?>
        <br> <br>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="fieldset">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'Codigo_Cliente')->widget(\yii\jui\AutoComplete::classname(), [
                        'options' => [
                            'class' => 'form-control',
                        ],
                        'clientOptions' => [
                            'source' => $model->getCliente(),
                        ],
                    ])
                    ?>
                </div>

                <div class="col-sm-3">
                    <?= $form->field($model, 'medio_pago')->dropDownList($model->getMedioDePago(), ['prompt' => 'Seleccione un Medio de Pago', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

                <div class="col-sm-3">
                    <?= $form->field($model, 'Estado_pago')->dropDownList($model->getEstadoDePago(), ['prompt' => 'Seleccione un Estado de Pago', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

                <div class="col-sm-2">
                    <?= $form->field($model, 'porcentaje_pagado')->textInput(['maxlength' => 3]) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'Codigo_club')->dropDownList($model->getClub(), ['prompt' => 'Seleccione un Club', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'Codigo_pasaporte')->dropDownList($model->getPasaporte(), ['prompt' => 'Seleccione un Pasaporte', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'cod_barra_pasaporte')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>
                <div class="col-sm-3 uso_normal">
                    <div class="form-group field-cliente-uso_interno">
                        <label class="control-label" for="venta-cod_barra_pasaporte">Seleccionar si es necesario</label>
                        <?= $form->field($model, 'uso_interno')->checkbox(['class' => 'check-selec', 'onchange' => 'valueChanged()']) ?>
                    </div>
                </div>
                <div class="uso_interno" style="display: none;">
                    <div class="col-sm-3">
                        <?= $form->field($model, 'cod_barra_pasaporte_manual')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-footer container-fluid foo">
            <div class="col-sm-12">
                <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
                <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Limpiar", ['create'], ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


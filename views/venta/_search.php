<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model app\models\VentaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="venta-search">
    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">Filtros de Cobranza</h3>
        </div>

        <div class="container-fluid">
            <p class="note"></p>
        </div>

        <?php $form = ActiveForm::begin([
            'action' => ['cobranza'],
            'method' => 'post',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>

        <div class="fieldset">
            <div class="container-fluid">

                <div class="col-sm-4">
                    <?php
                    echo $form->field($model, 'Fecha_Creado', [
                        'addon' => ['prepend' => ['content' => '<i class="glyphicon glyphicon-calendar"></i>']],
                        'options' => ['class' => 'drp-container form-group']
                    ])->widget(DateRangePicker::classname(), [
                        'useWithAddon' => true,
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'opens' => 'right',
                            'locale' => [
                                'cancelLabel' => 'Clear',
                                'format' => 'Y-m-d',
                            ]
                        ]]);
                    ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'salas')->dropDownList($model->getSalas(), ['prompt' => 'Seleccione un Sala', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

                <div class="col-sm-4">
                    <?php echo $form->field($model, 'estado_pago')->dropDownList($model->getEstadoDePago(), ['prompt' => 'Seleccione un Estado de Pago', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
            </div>
        </div>
        <div class="panel-footer container-fluid foo">
            <?= Html::submitButton("<i class=\"fa fa-search\" aria-hidden=\"true\"></i> Buscar", ['class' => 'btn btn-primary', 'id' => 'BtnBuscar']) ?>
            <?= Html::a('<i class="fa fa-eraser"></i> Limpiar', ['cobranza'], ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
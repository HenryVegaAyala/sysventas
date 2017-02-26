<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use app\models\Venta;

/**
 * @var yii\web\View $this
 * @var app\models\Reporte $model
 * @var yii\widgets\ActiveForm $form
 * @var $model app\models\Venta
 */

?>
<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <div class="fieldset">
        <div class="container-fluid">
            <?php $form = ActiveForm::begin(['options' => ['target' => '_blank']]);?>

            <div class="row">
                <div class="col-sm-3" id="combo">
                    <?= $form->field($model, 'Selectcombo')->dropDownList($model->getOpciones(), ['prompt' => 'Seleccione una Opcion ', 'class' => 'form-control loginmodal-container-combo', 'onchange' => 'Combo(this.value);']) ?>
                </div>

                <div class="col-sm-3" id="estadopago" style="display: none">
                    <?= $form->field($model, 'estado_pago')->dropDownList($model->getEstadoDePago(), ['prompt' => 'Seleccione un Estado de Pago', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

                <div class="col-sm-3" id="sala" style="display: none">
                    <?= $form->field($model, 'sala')->dropDownList($model->getSalas(), ['prompt' => 'Seleccione un Sala', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

                <div class="col-sm-3" id="club" style="display: none">
                    <?= $form->field($model, 'Codigo_club')->dropDownList($model->getClub(), ['prompt' => 'Seleccione un Club', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

                <div class="col-sm-3" id="usuario" style="display: none">
                    <?= $form->field($model, 'usuario')->textInput(['maxlength' => 15]) ?>
                </div>

                <?php echo Form::widget([

                    'model' => $model,
                    'form' => $form,
                    'columns' => 2,
                    'attributes' => [

                        'Fecha_Creado' => [
//                            'label' => 'Fecha Inicio',
                            'staticValue' => '<em>(not set)</em>',
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass' => '\kartik\widgets\DatePicker',
                            'hint' => 'Fecha de incio que solicita el reporte.'],


                        'Fecha_Eliminado' => [
//                            'label' => 'Fecha Final',
                            'staticValue' => '<em>(not set)</em>',
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass' => '\kartik\widgets\DatePicker',
                            'hint' => 'Fecha de final que solicita el reporte.'],
                    ]

                ]);
                ?>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'reporte')->dropDownList($model->getReporte(), ['prompt' => 'Seleccione un formato', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
            </div>

        </div>
    </div>
    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-cogs\" aria-hidden=\"true\"></i> Ejecutar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::resetButton($model->isNewRecord ? "<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Limpiar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

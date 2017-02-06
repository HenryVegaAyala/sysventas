<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\Anfitrion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Reporte de Anfitriones</h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <?php $form = ActiveForm::begin(['options' => ['target' => '_blank']]); ?>

    <div class="fieldset">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'Turno')->dropDownList($model->getTurno(), ['prompt' => 'Seleccionar turno', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'Descanso')->dropDownList($model->getDiaDescanso(), ['prompt' => 'Seleccionar dia de descanso', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                <?php echo Form::widget([

                    'model' => $model,
                    'form' => $form,
                    'columns' => 2,
                    'attributes' => [

                        'Fecha_Creado' => [
                            'label' => 'Fecha Inicio',
                            'staticValue' => '<em>(not set)</em>',
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass' => '\kartik\widgets\DatePicker',
                            'hint' => 'Puedes buscar en periodos'],

                        'Fecha_Modificado' => [
                            'label' => 'Fecha Final',
                            'staticValue' => '<em>(not set)</em>',
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass' => '\kartik\widgets\DatePicker',
//                            'hint' => 'Ingrese la fecha para solicitar el reporte, de lo contrario buscar todo.'
                        ],
                    ]

                ]);
                ?>
            </div>
        </div>
    </div>


    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-search\" aria-hidden=\"true\"></i> Buscar Todo" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Limpiar", ['anfitrion'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\Reporte $model
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

    <div class="fieldset">
        <div class="container-fluid">
            <?php $form = ActiveForm::begin(['options' => ['target' => '_blank']]); ?>

            <?php echo Form::widget([

                'model' => $model,
                'form' => $form,
                'columns' => 3,
                'attributes' => [

                    'fecha_inicio' => [
//                            'label' => 'Fecha Inicio',
                        'staticValue' => '<em>(not set)</em>',
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => '\kartik\widgets\DatePicker',
                        'hint' => 'Ingrese la fecha de incio que solicita el reporte.'],


                    'fecha_final' => [
//                            'label' => 'Fecha Final',
                        'staticValue' => '<em>(not set)</em>',
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => '\kartik\widgets\DatePicker',
                        'hint' => 'Ingrese la fecha de final que solicita el reporte.'],

                    'estado' => [
                        'type' => Form::INPUT_DROPDOWN_LIST,
                        'items' => $model->getEstado(),
                        'columnOptions' => ['width' => '185px'],
                        'options' => [
                            'prompt' => 'Seleccionar Estado'
                        ],

                    ],
                ]

            ]);
            ?>
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

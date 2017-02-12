<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\Autocomplete;
use app\models\Cliente;
use app\models\Beneficiario;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */

use synatree\dynamicrelations\DynamicRelations;
use yii\helpers\Url;

?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <?php $form = ActiveForm::begin([]); ?>

    <div class="fieldset">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5">
                    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($model, 'Apellido')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'dni')->textInput(['readonly' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Casa')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Casa2')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Celular')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Celular2')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Celular3')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'Email')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>
            </div>

            <div>
                <label class="form-control">Agendar Cliente: </label>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <?php $modelo = new \app\models\Reporte(); ?>
                    <?= $form->field($model, 'Estado')->dropDownList($modelo->getEstado(), ['prompt' => 'Seleccionar Tipificación', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

                <div class="col-sm-3">
                    <?php
                    echo $form->field($model, 'Agendado')->widget(DateTimePicker::classname(), [
                        'options' => ['placeholder' => 'Fecha y Hora'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd HH:mm:ss'
                        ]
                    ]);
                    ?>
                </div>
            </div>

        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar" : "<i class=\"fa fa-address-book-o\" aria-hidden=\"true\"></i> Agendar", ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::resetButton($model->isNewRecord ? "<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Limpiar" : "<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Limpiar", ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['asig-tlmk-cliente/index'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Anfitrion */
/* @var $form yii\widgets\ActiveForm */
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
                <div class="col-sm-3">
                    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'Apellido')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'DNI')->textInput(['readonly' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'Edad')->textInput(['readonly' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'Cargo')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'Telefono_Casa')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'Telefono_Celular')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'Turno')->dropDownList($model->getTurno(), ['prompt' => 'Seleccionar turno', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'Descanso')->dropDownList($model->getDiaDescanso(), ['prompt' => 'Seleccionar dia de descanso', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
            </div>
        </div>
    </div>


    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "Guardar" : "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar", ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="fieldset">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'Codigo_pasaporte')->textInput() ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'Codigo_Cliente')->textInput() ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'medio_pago')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'Estado_pago')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'porcentaje_pagado')->textInput() ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'cod_barra_pasaporte')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'cod_barra_pasaporte_manual')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>

        <div class="panel-footer container-fluid foo">
            <div class="col-sm-12">
                <?= Html::submitButton($model->isNewRecord ? "Guardar" : "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar", ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
                <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Limpiar", ['create'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['index'], ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
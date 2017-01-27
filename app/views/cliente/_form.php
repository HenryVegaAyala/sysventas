<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\Autocomplete;
use app\models\Cliente;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
        ],
    ]); ?>

    <div class="fieldset">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5">
                    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($model, 'Apellido')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'Edad')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'Distrito')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'Estado_Civil')->dropDownList($model->getEstadoCivil(), ['prompt' => 'Seleccione un Estado  Civil', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'Profesion')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Casa')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Celular')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'Traslado')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'Tarjeta_De_Credito')->textInput() ?>
                </div>

                <div class="col-sm-6 uso_normal" id="hides">
                    <?= $form->field($model, 'uso_interno')->checkbox(
                        ['template' => "<div class=\"col-lg-6\">{input} {label}</div>", 'class' => 'check-selec', 'onchange' => 'valueChanged()']
                    )->label('Seleccionar si es de uso interno') ?>
                </div>

                <div class="uso_interno" style="display: none;">
                    <div class="col-sm-3">
                        <?= $form->field($model, 'Promotor')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model, 'Local')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>

            <div class="hide">
                <?php
                $model = new Cliente();
                echo yii\jui\AutoComplete::widget([
                    'id' => 'cliente-distrito',
                    'name' => 'Cliente[Distrito]',
                    'clientOptions' => [
                        'source' => $model->getDistrito()
                    ],
                ])
                ?>
            </div>
        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::resetButton($model->isNewRecord ? "<i class=\"fa fa-eraser\" aria-hidden=\"true\"></i> Limpiar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

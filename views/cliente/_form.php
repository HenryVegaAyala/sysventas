<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\Autocomplete;
use app\models\Cliente;
use app\models\Beneficiario;

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
                    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($model, 'Apellido')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'dni')->textInput(['maxlength' => 15]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <?= $form->field($model, 'Edad')->textInput(['maxlength' => 2]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'Direccion')->textInput() ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($model, 'Distrito')->widget(\yii\jui\AutoComplete::classname(), [
                        'options' => [
                            'class' => 'form-control',
                        ],
                        'clientOptions' => [
                            'source' => $model->getDistrito(),
                        ],
                    ]) ?>
                </div>

                <div class="col-sm-3">
                    <?= $form->field($model, 'Traslado')->dropDownList($model->getTraslado(), ['prompt' => 'Seleccionar tipo de Traslado', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'Tarjeta_De_Credito')->dropDownList($model->getTarjeta(), ['prompt' => 'Seleccione una Tarjeta', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'Estado_Civil')->dropDownList($model->getEstadoCivil(), ['prompt' => 'Seleccione un Estado  Civil', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'Profesion')->widget(\yii\jui\AutoComplete::classname(), [
                        'options' => [
                            'class' => 'form-control',
                        ],
                        'clientOptions' => [
                            'source' => $model->getCarrera(),
                        ],
                    ]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Casa')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Casa2')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Celular')->textInput(['maxlength' => true]) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Celular2')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'Telefono_Celular3')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div>
                <label class="form-control">Seleccionar si es de uso interno: </label>
            </div>

            <div class="row">

                <div class="col-sm-3 uso_normal">
                    <div class="form-group field-cliente-uso_interno">
                        <?= $form->field($model, 'uso_interno')->checkbox(['class' => 'check-selec', 'onchange' => 'valueChanged()']) ?>
                    </div>
                </div>
                <div class="uso_interno" style="display: none;">
                    <div class="col-sm-3">
                        <?= $form->field($model, 'Promotor')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model, 'Super_Promotor')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model, 'Jefe_Promotor')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model, 'Local')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?= DynamicRelations::widget([
                        'title' => 'Beneficiarios:',
                        'collection' => $model->beneficiarios,
                        'viewPath' => '@app/views/beneficiario/_form.php',
                        'collectionType' => new \app\models\Beneficiario(),

                    ]); ?>
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

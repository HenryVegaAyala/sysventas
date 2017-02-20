<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\AsigTlmkClienteSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="asig-tlmk-cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Codigo_Cliente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!--<div class="panel panel-default">-->
<!---->
<!--    <div class="panel-heading">-->
<!--        <h3 class="panel-title">--><?//= $this->title ?><!--</h3>-->
<!--    </div>-->
<!---->
<!--    <div class="container-fluid">-->
<!--        <p class="note"></p>-->
<!--    </div>-->
<!--    --><?php //$form = ActiveForm::begin(); ?>
<!---->
<!--    <div class="fieldset">-->
<!--        <div class="container-fluid">-->
<!---->
<!--            <div class="row">-->
<!--                <div class="col-sm-6">-->
<!--                    --><?//= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>
<!--                </div>-->
<!---->
<!--                <div class="col-sm-6">-->
<!--                    --><?//= $form->field($model, 'Apellido')->textInput(['maxlength' => true]) ?>
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="row">-->
<!--                <div class="col-sm-6">-->
<!--                    --><?//= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>
<!--                </div>-->
<!---->
<!--                <div class="col-sm-6">-->
<!--                    --><?//= $form->field($model, 'Codigo_Rol')->dropDownList($model->getRol(), ['prompt' => 'Seleccione una Categoria']) ?>
<!--                </div>-->
<!---->
<!--            </div>-->
<!---->
<!--            <div class="row">-->
<!--                <div class="col-sm-6">-->
<!--                    --><?//= $form->field($model, 'Contrasena')->passwordInput(['maxlength' => true]) ?>
<!--                </div>-->
<!---->
<!--                <div class="col-sm-6">-->
<!--                    --><?//= $form->field($model, "password_repeat")->passwordInput(['value' => $model->Contrasena]) ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="panel-footer container-fluid foo">-->
<!--        <div class="col-sm-12">-->
<!--            --><?//= Html::submitButton($model->isNewRecord ? "Guardar" : "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar", ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
<!--            --><?//= Html::resetButton($model->isNewRecord ? "<i class=\"fa fa-eraser\" aria-hidden=\"true\"></i> Limpiar" : "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Restablecer", ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
<!--            --><?//= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['producto/index'], ['class' => 'btn btn-primary']) ?>
<!--        </div>-->
<!--    </div>-->
<!--    --><?php //ActiveForm::end(); ?>
<!--</div>-->
<!--</div>-->

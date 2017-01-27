<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
    ]); ?>

    <div class="fieldset">
        <div class="container-fluid">

            <div class="col-sm-3">
                <?= $form->field($model, 'Codigo_Usuario') ?>
            </div>

            <div class="col-sm-3">
                <?= $form->field($model, 'Nombre') ?>
            </div>

            <div class="col-sm-3">
                <?= $form->field($model, 'Apellido') ?>
            </div>

            <div class="col-sm-3">
                <?= $form->field($model, 'Codigo_Rol')->dropDownList($model->getRol(), ['prompt' => 'Seleccione una Categoria', 'class' => 'form-control loginmodal-container-combo']) ?>
            </div>

        </div>
        <div class="panel-footer container-fluid foo">
            <?= Html::submitButton("<i class=\"fa fa-search\" aria-hidden=\"true\"></i> Buscar", ['class' => 'btn btn-primary', 'id' => 'BtnBuscar']) ?>
            <?= Html::resetButton("<i class=\"fa fa-eraser\" aria-hidden=\"true\"></i> Limpiar", ['class' => 'btn btn-primary']) ?>
            <?= Html::button("<i class=\"fa fa-times\" aria-hidden=\"true\"></i> Cerrar", ['class' => 'btn btn-primary', 'id' => 'BtnCerrar']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

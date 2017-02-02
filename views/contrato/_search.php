<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContratoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contrato-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
        'id' => 'formulario'
    ]); ?>

    <div class="fieldset">
        <div class="container-fluid">

            <div class="col-sm-3">
                <?= $form->field($model, 'Codigo_Contrato') ?>
            </div>

            <div class="col-sm-3">
                <?= $form->field($model, 'Nombre') ?>
            </div>

            <div class="col-sm-3">
                <?= $form->field($model, 'Apellidos') ?>
            </div>

            <div class="col-sm-3">
                <?php echo $form->field($model, 'Dni_1') ?>
            </div>

        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <?= Html::submitButton("<i class=\"fa fa-search\" aria-hidden=\"true\"></i> Buscar", ['class' => 'btn btn-primary', 'id' => 'btnBuscar']) ?>
        <?= Html::resetButton("<i class=\"fa fa-eraser\" aria-hidden=\"true\"></i> Limpiar", ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
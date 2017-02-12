<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AsigTlmkClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asig-tlmk-cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'Codigo_telemarketing') ?>

    <?= $form->field($model, 'Codigo_Cliente') ?>

    <?= $form->field($model, 'Fecha_Creada') ?>

    <?= $form->field($model, 'Fecha_Modificada') ?>

    <?php // echo $form->field($model, 'Fecha_Eliminada') ?>

    <?php // echo $form->field($model, 'Usuario_Creado') ?>

    <?php // echo $form->field($model, 'Usuario_Modificado') ?>

    <?php // echo $form->field($model, 'Usuario_Eliminado') ?>

    <?php // echo $form->field($model, 'Fecha_Llamado') ?>

    <?php // echo $form->field($model, 'Estado') ?>

    <?php // echo $form->field($model, 'fecha_asignacion_codigo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

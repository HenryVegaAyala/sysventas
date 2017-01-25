<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Codigo_Cliente') ?>

    <?= $form->field($model, 'Nombre') ?>

    <?= $form->field($model, 'Apellido') ?>

    <?= $form->field($model, 'Profesion') ?>

    <?= $form->field($model, 'Edad') ?>

    <?php // echo $form->field($model, 'Estado_Civil') ?>

    <?php // echo $form->field($model, 'Distrito') ?>

    <?php // echo $form->field($model, 'Direccion') ?>

    <?php // echo $form->field($model, 'Telefono_Casa') ?>

    <?php // echo $form->field($model, 'Telefono_Celular') ?>

    <?php // echo $form->field($model, 'Email') ?>

    <?php // echo $form->field($model, 'Traslado') ?>

    <?php // echo $form->field($model, 'Tarjeta_De_Credito') ?>

    <?php // echo $form->field($model, 'Promotor') ?>

    <?php // echo $form->field($model, 'Local') ?>

    <?php // echo $form->field($model, 'Observacion') ?>

    <?php // echo $form->field($model, 'Fecha_Creado') ?>

    <?php // echo $form->field($model, 'Fecha_Modificado') ?>

    <?php // echo $form->field($model, 'Fecha_Eliminado') ?>

    <?php // echo $form->field($model, 'Usuario_Creado') ?>

    <?php // echo $form->field($model, 'Usuario_Modificado') ?>

    <?php // echo $form->field($model, 'Usuario_Eliminado') ?>

    <?php // echo $form->field($model, 'Estado') ?>

    <?php // echo $form->field($model, 'Codigo_Opc') ?>

    <?php // echo $form->field($model, 'Codigo_Tlmk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

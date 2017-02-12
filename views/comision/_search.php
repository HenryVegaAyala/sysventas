<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\ComisionSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="comision-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Codigo') ?>

    <?= $form->field($model, 'Nombre') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'porcentaje') ?>

    <?= $form->field($model, 'Fecha_Creado') ?>

    <?php // echo $form->field($model, 'Fecha_Modificado') ?>

    <?php // echo $form->field($model, 'Usuario_Creado') ?>

    <?php // echo $form->field($model, 'Usuario_Modificado') ?>

    <?php // echo $form->field($model, 'Estado') ?>

    <?php // echo $form->field($model, 'codigo_anfitrion') ?>

    <?php // echo $form->field($model, 'codigo_supervisor_anfitrion') ?>

    <?php // echo $form->field($model, 'codigo_jefe_anfitrion') ?>

    <?php // echo $form->field($model, 'no_access_closer') ?>

    <?php // echo $form->field($model, 'no_access_liner') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

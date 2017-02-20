<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\CertificadoSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="certificado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Codigo_certificado') ?>

    <?= $form->field($model, 'Codigo_venta') ?>

    <?= $form->field($model, 'Codigo_pasaporte') ?>

    <?= $form->field($model, 'Nombre') ?>

    <?= $form->field($model, 'Vigencia') ?>

    <?php // echo $form->field($model, 'Precio') ?>

    <?php // echo $form->field($model, 'Stock') ?>

    <?php // echo $form->field($model, 'codigo_barra') ?>

    <?php // echo $form->field($model, 'Fecha_Creado') ?>

    <?php // echo $form->field($model, 'Fecha_Modificado') ?>

    <?php // echo $form->field($model, 'Fecha_Eliminado') ?>

    <?php // echo $form->field($model, 'Usuario_Creado') ?>

    <?php // echo $form->field($model, 'Usuario_Modificado') ?>

    <?php // echo $form->field($model, 'Usuario_Eliminado') ?>

    <?php // echo $form->field($model, 'Estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

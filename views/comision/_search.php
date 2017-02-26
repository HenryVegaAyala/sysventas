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

    <?= $form->field($model, 'Codigo_venta') ?>

    <?= $form->field($model, 'Digitador') ?>

    <?= $form->field($model, 'OPC') ?>

    <?= $form->field($model, 'Tienda') ?>

    <?php // echo $form->field($model, 'SupervisorPromotor') ?>

    <?php // echo $form->field($model, 'SuperviorGeneralOPC') ?>

    <?php // echo $form->field($model, 'DirectordeMercadero') ?>

    <?php // echo $form->field($model, 'TLMK') ?>

    <?php // echo $form->field($model, 'SupervisordeTLMK') ?>

    <?php // echo $form->field($model, 'Confirmadora') ?>

    <?php // echo $form->field($model, 'DirectordeTLMK') ?>

    <?php // echo $form->field($model, 'Liner') ?>

    <?php // echo $form->field($model, 'Closer') ?>

    <?php // echo $form->field($model, 'Closer2') ?>

    <?php // echo $form->field($model, 'JefedeSala') ?>

    <?php // echo $form->field($model, 'DirectordeVentas') ?>

    <?php // echo $form->field($model, 'DirectordeProyectos') ?>

    <?php // echo $form->field($model, 'GenerenciaGeneral') ?>

    <?php // echo $form->field($model, 'monto') ?>

    <?php // echo $form->field($model, 'Fecha_Creado') ?>

    <?php // echo $form->field($model, 'Fecha_Modificado') ?>

    <?php // echo $form->field($model, 'Usuario_Creado') ?>

    <?php // echo $form->field($model, 'Usuario_Modificado') ?>

    <?php // echo $form->field($model, 'Estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

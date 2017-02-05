<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\FacturaSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="factura-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'Codigo_Cliente') ?>

    <?= $form->field($model, 'Fecha_Creado') ?>

    <?= $form->field($model, 'Fecha_Modificado') ?>

    <?= $form->field($model, 'Fecha_Eliminado') ?>

    <?php // echo $form->field($model, 'Usuario_Creado') ?>

    <?php // echo $form->field($model, 'Usuario_Modificado') ?>

    <?php // echo $form->field($model, 'Usuario_Eliminado') ?>

    <?php // echo $form->field($model, 'Estado') ?>

    <?php // echo $form->field($model, 'Codigo_Combo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

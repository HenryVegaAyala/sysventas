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

    <?= $form->field($model, 'codigo_asig') ?>

    <?= $form->field($model, 'codigo_tlmk_cliente') ?>

    <?= $form->field($model, 'Codigo_Usuario') ?>

    <?= $form->field($model, 'Codigo_Cliente') ?>

    <?= $form->field($model, 'Fecha_Creada') ?>

    <?php // echo $form->field($model, 'Fecha_Modificada') ?>

    <?php // echo $form->field($model, 'Fecha_Eliminada') ?>

    <?php // echo $form->field($model, 'Usuario_Creado') ?>

    <?php // echo $form->field($model, 'Usuario_Modificado') ?>

    <?php // echo $form->field($model, 'Usuario_Eliminado') ?>

    <?php // echo $form->field($model, 'Fecha_Llamado') ?>

    <?php // echo $form->field($model, 'Estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

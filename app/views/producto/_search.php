<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Codigo_Producto') ?>

    <?= $form->field($model, 'Nombre') ?>

    <?= $form->field($model, 'Precio') ?>

    <?= $form->field($model, 'Precio_por_Noche') ?>

    <?= $form->field($model, 'Vigencia') ?>

    <?php // echo $form->field($model, 'Desc_Afiliado') ?>

    <?php // echo $form->field($model, 'Combo_Adquirido') ?>

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

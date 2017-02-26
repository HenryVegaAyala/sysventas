<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PorcentajeComisionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="porcentaje-comision-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Codigo') ?>

    <?= $form->field($model, 'Codigo_usuario') ?>

    <?= $form->field($model, 'Usuario') ?>

    <?= $form->field($model, 'procentaje') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

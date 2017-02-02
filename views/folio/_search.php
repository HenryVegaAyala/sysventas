<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FolioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Codigo_Folio') ?>

    <?= $form->field($model, 'Valor') ?>

    <?= $form->field($model, 'Descripcion') ?>

    <?= $form->field($model, 'Estado') ?>

    <?= $form->field($model, 'Fecha_Modificada') ?>

    <?php // echo $form->field($model, 'Usuario_Modificado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

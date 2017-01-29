<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Documento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Codigo_Documento')->textInput() ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'archivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha_Creado')->textInput() ?>

    <?= $form->field($model, 'Fecha_Modificado')->textInput() ?>

    <?= $form->field($model, 'Fecha_Eliminado')->textInput() ?>

    <?= $form->field($model, 'Usuario_Creado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Usuario_Eliminado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Usuario_Modificado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Estado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

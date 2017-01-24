<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Codigo_Cliente')->textInput() ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Profesion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Observacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha_Creado')->textInput() ?>

    <?= $form->field($model, 'Fecha_Modificado')->textInput() ?>

    <?= $form->field($model, 'Fecha_Eliminado')->textInput() ?>

    <?= $form->field($model, 'Usuario_Creado')->textInput() ?>

    <?= $form->field($model, 'Usuario_Modificado')->textInput() ?>

    <?= $form->field($model, 'Usuario_Eliminado')->textInput() ?>

    <?= $form->field($model, 'Estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Codigo_Opc')->textInput() ?>

    <?= $form->field($model, 'Codigo_Tlmk')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Combo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="combo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Codigo_venta')->textInput() ?>

    <?= $form->field($model, 'convetidor1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'convetidor2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Observacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Regalos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha_Creado')->textInput() ?>

    <?= $form->field($model, 'Fecha_Modificado')->textInput() ?>

    <?= $form->field($model, 'Fecha_Eliminado')->textInput() ?>

    <?= $form->field($model, 'Usuario_Creado')->textInput() ?>

    <?= $form->field($model, 'Usuario_Modificado')->textInput() ?>

    <?= $form->field($model, 'Usuario_Eliminado')->textInput() ?>

    <?= $form->field($model, 'Estado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comision */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comision-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Digitador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OPC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Tienda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SupervisorPromotor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SuperviorGeneralOPC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DirectordeMercadero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TLMK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SupervisordeTLMK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Confirmadora')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DirectordeTLMK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Liner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Closer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Closer2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JefedeSala')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DirectordeVentas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DirectordeProyectos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GenerenciaGeneral')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

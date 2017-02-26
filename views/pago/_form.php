<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use synatree\dynamicrelations\DynamicRelations;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Codigo_venta')->textInput() ?>

    <?= $form->field($model, 'tipo_pago')->textInput() ?>

    <?= $form->field($model, 'estado_pago')->textInput() ?>

    <?= $form->field($model, 'monto_pagado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monto_ingresado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monto_restante')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-sm-12">
            <?= DynamicRelations::widget([
                'title' => 'Productos Adicionales:',
                'collection' => $model->formasPagos,
                'viewPath' => '@app/views/formas-pago/_form.php',
                'collectionType' => new \app\models\FormasPago,

            ]); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

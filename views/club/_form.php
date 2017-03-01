<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Club */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="fieldset">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-3">
                    <?= $form->field($model, 'Precio')->textInput(['maxlength' => true, 'id' => 'precio']) ?>
                </div>

                <div class="col-sm-3">
                    <?= $form->field($model, 'Dias_noches')->textInput(['onchange' => "OperacionClub($('#precio').val(),this.value);return false;"]) ?>
                </div>

                <div class="col-sm-3">
                    <?= $form->field($model, 'Precio_por_Noche')->textInput(['maxlength' => true]) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'Vigencia')->textInput() ?>
                </div>

                <div class="col-sm-3">
                    <?= $form->field($model, 'Desc_Afiliado')->textInput() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Limpiar", ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

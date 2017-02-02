<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
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
                <div class="col-sm-6">
                    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'Apellido')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'Codigo_Rol')->dropDownList($model->getRol(), ['prompt' => 'Seleccione una Categoria', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
                
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'Contrasena')->passwordInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, "password_repeat")->passwordInput(['value' => $model->Contrasena]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "Guardar" : "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar", ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::resetButton($model->isNewRecord ? "<i class=\"fa fa-eraser\" aria-hidden=\"true\"></i> Limpiar" : "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Restablecer", ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

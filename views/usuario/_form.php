<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use app\models\Rol;
/**
 * @var yii\web\View $this
 * @var app\models\Usuario $model
 * @var yii\widgets\ActiveForm $form
 */
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
                <div class="col-sm-4">
                    <?= $form->field($model, 'username')->textInput() ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'auth_key')->dropDownList($model->getRoles(Yii::$app->user->identity->Codigo_Rol), ['prompt' => 'Seleccione un Rol', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'password_hash')->passwordInput() ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'status')->dropDownList($model->getEstado(), ['prompt' => 'Seleccione un Estado', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Cancelar", ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
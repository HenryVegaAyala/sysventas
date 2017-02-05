<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\Usuario $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= 'Actualizar Usuario: ' . $model->username ?></h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="fieldset">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'username')->textInput(['readonly' => true]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'email')->textInput(['readonly' => true]) ?>
                </div>

                <div class=" col-sm-4">
                    <?= $form->field($model, 'auth_key')->dropDownList($model->getRoles(Yii::$app->user->identity->Codigo_Rol), ['disabled' => true,'class' => 'form-control loginmodal-container-combo', 'value' => $model->getRoles(Yii::$app->user->identity->Codigo_Rol) ]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'password_hash')->passwordInput(['value' => $model->pwdDes]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'password_repeat')->passwordInput(['value' => $model->pwdDes]) ?>
                </div>

                <div class="col-sm-4">
                    <?= $form->field($model, 'status')->dropDownList($model->getEstado(), ['disabled' => true,'prompt' => 'Seleccione un Estado', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "Guardar" : "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar", ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\Autocomplete;
use app\models\FechaAsignacion;
use app\models\AsigTlmkCliente;

/* @var $this yii\web\View */
/* @var $model app\models\FechaAsignacion */
/* @var $form yii\widgets\ActiveForm */

use synatree\dynamicrelations\DynamicRelations;
use yii\helpers\Url;

?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <?php $form = ActiveForm::begin([]); ?>

    <div class="fieldset">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <?= $form->field($model, 'Fecha_Creada')->textInput(['maxlength' => true,'value' => date('d-m-Y'),'readonly' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?= DynamicRelations::widget([
                        'title' => 'Asignar Telemarketing:',
                        'collection' => $model->asigTlmkClientes,
                        'viewPath' => '@app/views/asig-tlmk-cliente/_form.php',
                        'collectionType' => new \app\models\AsigTlmkCliente(),

                    ]); ?>
                </div>
            </div>

        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Limpiar", ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
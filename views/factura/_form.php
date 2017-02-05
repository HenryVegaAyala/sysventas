<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

use synatree\dynamicrelations\DynamicRelations;
use yii\helpers\Url;

use app\models\DFactura;
use app\models\DFacturaSearch;

/**
 * @var yii\web\View $this
 * @var app\models\Factura $model
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
                    <?= $form->field($model, 'id')->textInput(['maxlength' => true,'readonly' => true]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'Codigo_Cliente')->widget(\yii\jui\AutoComplete::classname(), [
                        'options' => [
                            'class' => 'form-control',
                        ],
                        'clientOptions' => [
                            'source' => $model->getCliente(),
                        ],
                    ]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'Codigo_Combo')->dropDownList($model->getPasaporte(), ['prompt' => 'Seleccione un Pasaporte', 'class' => 'form-control loginmodal-container-combo']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= DynamicRelations::widget([
                        'title' => 'Productos Adicionales:',
                        'collection' => $model->dFacturas,
                        'viewPath' => '@app/views/dfactura/_form.php',
                        'collectionType' => new \app\models\dfactura,

                    ]); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Guardar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
        <?= Html::resetButton($model->isNewRecord ? "<i class=\"fa fa-refresh\" aria-hidden=\"true\"></i> Cancelar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

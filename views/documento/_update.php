<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Documento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->title ?></h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <?php $form = ActiveForm::begin([
        "method" => "post",
        "enableClientValidation" => true,
        "options" => ["enctype" => "multipart/form-data"],
    ]);
    ?>

    <div class="fieldset">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'archivo2')->fileInput(['class' => 'form-control', 'multiple' => true]) ?>
                    <center>
                        <?php if (!$model->isNewRecord) : ?>
                            <?php if ($model->extension != 'pdf') { ?>
                                <?php echo Html::img(Yii::getAlias('@groupgygUrlImagen') . '/' . $model->archivo, ['height' => '120px']); ?>
                            <?php } else { ?>
                                <?= Html::img('help/pdf.png', ['height' => '120px']); ?>
                            <?php } ?>
                            <p><?php echo $model->archivo ?></p>
                        <?php endif; ?>
                    </center>
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
        <?php ActiveForm::end(); ?>
    </div>
</div>
<!--    $form=$this->beginWidget('CActiveForm', array(-->
<!--        'id'=>'csv-form',-->
<!--        'enableAjaxValidation'=>false,-->
<!--        'htmlOptions'=>array('enctype' => 'multipart/form-data'),-->
<!--    ));-->
<!--        $this->widget('CMultiFileUpload', array(-->
<!--            'model'=>$model,-->
<!--            'name' => 'archivo',-->
<!--            'max'=>1,-->
<!--            'accept' => 'csv',-->
<!--            'duplicate' => 'Duplicate file!',-->
<!--            'denied' => 'Invalid file type',-->
<!--        ));-->
<!--       -->


<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?= "Seleccione el formato CSV para importar." ?></h3>
    </div>

    <div class="container-fluid">
        <p class="note"></p>
    </div>

    <?php $form = ActiveForm::begin(
        [
            "method" => "post",
            "options" => ["enctype" => "multipart/form-data"]
        ])
    ?>

    <div class="fieldset">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'archivo')->fileInput(['class' => 'form-control', 'multiple' => true,'id' => 'archivo']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer container-fluid foo">
        <div class="col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? "<i class=\"fa fa-cloud-upload\" aria-hidden=\"true\"></i> Guardar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary ']) ?>
            <?= Html::resetButton($model->isNewRecord ? "<i class=\"fa fa-eraser\" aria-hidden=\"true\"></i> Limpiar" : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;
use \kartik\widgets\Select2;
use synatree\dynamicrelations\DynamicRelations;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var app\models\DFactura $model
 * @var yii\widgets\ActiveForm $form
 */

$uniq = uniqid();

if ($model->primaryKey) {

    $removeAttr = 'data-dynamic-relation-remove-route="' . Url::toRoute(['delete', 'id' => $model->primaryKey]) . '"';
    $frag = "Dfactura[{$model->primaryKey}]";
} else {
    $removeAttr = "";
    $frag = "Dfactura[new][$uniq]";
}
?>

<div class="dfactura-form" <?= $removeAttr; ?> >

    <div class="row">

        <div class="col-sm-2">
            <div class="form-group field-dfactura-Cantidad">
                <?= Html::input('text', $frag . '[Cantidad]', $model->Cantidad, ['id' => 'dfactura-cantidad', 'class' => 'form-control', 'placeholder' => 'Cantidad', 'onkeyup' => "calcula();", 'value' => '']) ?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group field-dfactura-producto">
                <?= Html::input('text', $frag . '[Descripcion]', $model->Descripcion, ['id' => 'dfactura-Descripcion', 'class' => 'form-control', 'placeholder' => 'Contenido', 'value' => '']) ?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group field-dfactura-precio">
                <?= Html::input('text', $frag . '[precio]', $model->precio, ['id' => 'dfactura-precio', 'class' => 'form-control', 'placeholder' => 'Precio', 'onkeyup' => "calcula();"]) ?>
                <div class="help-block"></div>
            </div>

        </div>

        <div class="col-sm-2">
            <div class="form-group field-dfactura-Total">
                <?= Html::input('text', $frag . '[Total]', $model->Total, ['id' => 'dfactura-Total', 'class' => 'form-control', 'readonly' => 'true', 'placeholder' => 'Total', 'value' => '']) ?>
                <div class="help-block"></div>
            </div>
        </div>

    </div>
</div>


<?php


$js = <<<JS

    var Esquema = "$frag";
    var Cantidad[] = Esquema.concat('[Cantidad]');
    var Precio[] = Esquema.concat('[precio]');
    var Total[] = Esquema.concat('[Total]');

    function calcula(){
        var a = Number(document.getElementsByName(Cantidad).value );
        var b = Number(document.getElementsByName(Precio).value );
        var c = a * b;
        document.getElementsByName(Total).value = c;
    }
JS;
?>

<?php $this->registerJs($js, View::POS_READY); ?>

<?php $this->registerJs($js, View::POS_HEAD); ?>


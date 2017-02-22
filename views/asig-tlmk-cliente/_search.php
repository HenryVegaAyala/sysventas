<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\AsigTlmkClienteSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="asig-tlmk-cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= Html::dropDownList('[Codigo_Cliente]', $model->Codigo_Cliente, $model->getListaClientes(), ["id" => "Beneficiario-Estado_Civil", 'class' => 'form-control', 'prompt' => 'Seleccionar Cliente']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\PorcentajeComision $model
 */

$this->title = 'Actualizar Porcentaje de Comision';
$this->params['breadcrumbs'][] = ['label' => 'Porcentaje Comisions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Codigo, 'url' => ['view', 'id' => $model->Codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="porcentaje-comision-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

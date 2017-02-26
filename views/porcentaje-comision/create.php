<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\PorcentajeComision $model
 */

/* @var $this yii\web\View */
/* @var $model app\models\PorcentajeComision */

$this->title = 'Porcentaje de Comision';
$this->params['breadcrumbs'][] = ['label' => 'Porcentaje Comisions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="porcentaje-comision-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

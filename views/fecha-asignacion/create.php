<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FechaAsignacion */

$this->title = 'Create Fecha Asignacion';
$this->params['breadcrumbs'][] = ['label' => 'Fecha Asignacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fecha-asignacion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

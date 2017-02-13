<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pasaporte */

$this->title = 'Actualizar Pasaporte:';
$this->params['breadcrumbs'][] = ['label' => 'Pasaportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Codigo_pasaporte, 'url' => ['view', 'id' => $model->Codigo_pasaporte]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pasaporte-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

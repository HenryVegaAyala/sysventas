<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pasaporte */

$this->title = 'Agregar Nuevo Pasaporte';
$this->params['breadcrumbs'][] = ['label' => 'Pasaportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasaporte-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

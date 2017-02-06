<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anfitrion */

$this->title = 'Actualizar datos del Anfitrión: ' . $model->Nombre;
?>
<div class="anfitrion-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

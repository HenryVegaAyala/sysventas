<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Folio */

$this->title = 'Actualizar Configuración';
$this->params['breadcrumbs'][] = ['label' => 'Actualizar Configuración', 'url' => ['index']];
?>
<div class="folio-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

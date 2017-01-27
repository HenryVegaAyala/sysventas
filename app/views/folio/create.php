<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Folio */

$this->title = 'Nueva Configuración';
$this->params['breadcrumbs'][] = ['label' => 'Nueva Configuración', 'url' => ['index']];
?>
<div class="folio-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Documento */

$this->title = 'Actualizar Documento: ' . $model->Codigo_Documento;
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="documento-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

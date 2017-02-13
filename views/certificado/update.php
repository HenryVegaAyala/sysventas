<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Certificado */

$this->title = 'Update Certificado: ' . $model->Codigo_certificado;
$this->params['breadcrumbs'][] = ['label' => 'Certificados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Codigo_certificado, 'url' => ['view', 'id' => $model->Codigo_certificado]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="certificado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

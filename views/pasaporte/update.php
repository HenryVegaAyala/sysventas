<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pasaporte */

$this->title = 'Update Pasaporte: ' . $model->Codigo_pasaporte;
$this->params['breadcrumbs'][] = ['label' => 'Pasaportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Codigo_pasaporte, 'url' => ['view', 'id' => $model->Codigo_pasaporte]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pasaporte-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Folio */

$this->title = 'Update Folio: ' . $model->Codigo_Folio;
$this->params['breadcrumbs'][] = ['label' => 'Folios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Codigo_Folio, 'url' => ['view', 'id' => $model->Codigo_Folio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="folio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

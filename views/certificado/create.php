<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Certificado */

$this->title = 'Nuevo Certificado';
$this->params['breadcrumbs'][] = ['label' => 'Certificados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificado-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

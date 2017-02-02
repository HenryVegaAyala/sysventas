<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Documento */

$this->title = 'Registrar Documento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

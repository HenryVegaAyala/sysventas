<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = 'Registrar Nuevos Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

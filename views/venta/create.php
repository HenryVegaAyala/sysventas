<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Venta */

$this->title = 'Regitsrar Venta';
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venta-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

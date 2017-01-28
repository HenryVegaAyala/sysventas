<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = 'Producto Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

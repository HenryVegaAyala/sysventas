<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = 'Actualizar Producto';
$this->params['breadcrumbs'][] = ['label' => 'Actualizar Producto', 'url' => ['index']];
?>
<div class="producto-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

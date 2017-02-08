<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Factura $model
 */

$this->title = 'Actualizar Factura: ' . ' ' . str_pad($model->id, 10, "0", STR_PAD_LEFT);
?>
<div class="factura-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

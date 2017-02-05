<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Factura $model
 */

$this->title = 'Actualizar Factura: ' . ' ' . $model->id;
?>
<div class="factura-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

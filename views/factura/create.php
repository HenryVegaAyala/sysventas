<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Factura $model
 */

$this->title = 'Nueva Factura';
?>
<div class="factura-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

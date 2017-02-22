<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Reporte $model
 */

$this->title = 'Reporte General';
?>
<div class="reporte-create">

    <?=

    $this->render('_venta', ['model' => $model,])

    ?>

</div>

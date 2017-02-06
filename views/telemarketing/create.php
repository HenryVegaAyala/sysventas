<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Telemarketing */

$this->title = 'Reporte de Telemarketing';
?>
<div class="telemarketing-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

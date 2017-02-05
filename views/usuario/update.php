<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Usuario $model
 */

$this->title = 'Actualizar Usuario: ' . ' ' . $model->username;
?>
<div class="usuario-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Usuario $model
 */

$this->title = 'Actualizar Usuario: ' . ' ' . $model->username;
?>
<div class="usuario-update">

    <?php
    $rol = Yii::$app->user->identity->Codigo_Rol;
    if ($rol != 2) { ?>
        <?= $this->render('_update', ['model' => $model,]) ?>
    <?php } else { ?>
        <?= $this->render('_updateP', ['model' => $model,]) ?>
    <?php } ?>
</div>

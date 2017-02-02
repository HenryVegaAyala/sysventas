<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Actualizar Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuario', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar Usuario';
?>
<div class="usuario-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

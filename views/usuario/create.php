<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Usuario $model
 */

$this->title = 'Nuevo Usuario';
?>
<div class="usuario-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

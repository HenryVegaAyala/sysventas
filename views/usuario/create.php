<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Usuario $model
 */

$this->title = 'Nuevo Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

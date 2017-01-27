<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = 'Registrar cliente';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

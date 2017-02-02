<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Nuevo Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-create">

    <?php if ($mensaje == '') { ?>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            <?= "<i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i>" . " " . $mensaje . "." ?>
        </div>
    <?php } ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

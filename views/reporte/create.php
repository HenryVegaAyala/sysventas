<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Reporte $model
 */

$this->title = 'Reporte General';
?>
<div class="reporte-create">

    <?php if (Yii::$app->user->identity->Codigo_Rol == 4) { ?>
        <?= $this->render('_cliente', [
            'model' => $model,
        ]) ?>
    <?php } elseif(Yii::$app->user->identity->Codigo_Rol == 17) { ?>
        <?= $this->render('_telemarketing', [
            'model' => $model,
        ]) ?>
    <?php } else { ?>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    <?php } ?>
    

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Club */

$this->title = 'Actualizar Club';
$this->params['breadcrumbs'][] = ['label' => 'Clubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Codigo_club, 'url' => ['view', 'id' => $model->Codigo_club]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="club-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

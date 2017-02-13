<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Club */

$this->title = 'Regitsrar Nuevo Club';
$this->params['breadcrumbs'][] = ['label' => 'Clubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="club-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

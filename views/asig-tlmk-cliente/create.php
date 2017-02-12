<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AsigTlmkCliente */

$this->title = 'Create Asig Tlmk Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Asig Tlmk Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asig-tlmk-cliente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

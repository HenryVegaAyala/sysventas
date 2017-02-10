<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\DFactura $model
 */

$this->title = 'Update Dfactura: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dfacturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dfactura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>

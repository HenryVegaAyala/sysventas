<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\DFactura $model
 */

$this->title = 'Create Dfactura';
$this->params['breadcrumbs'][] = ['label' => 'Dfacturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dfactura-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

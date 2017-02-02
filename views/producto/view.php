<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = $model->Codigo_Producto;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Codigo_Producto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Codigo_Producto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Codigo_Producto',
            'Nombre',
            'Precio',
            'Precio_por_Noche',
            'Vigencia',
            'Desc_Afiliado',
            'Fecha_Creado',
            'Fecha_Modificado',
            'Fecha_Eliminado',
            'Usuario_Creado',
            'Usuario_Modificado',
            'Usuario_Eliminado',
            'Estado',
        ],
    ]) ?>

</div>

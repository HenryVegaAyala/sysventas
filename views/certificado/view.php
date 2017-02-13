<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Certificado */

$this->title = $model->Codigo_certificado;
$this->params['breadcrumbs'][] = ['label' => 'Certificados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Codigo_certificado], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Codigo_certificado], [
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
            'Codigo_certificado',
            'Nombre',
            'Vigencia',
            'Precio',
            'Stock',
            'Codigo_pasaporte_afiliado',
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

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Club */

$this->title = $model->Codigo_club;
$this->params['breadcrumbs'][] = ['label' => 'Clubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="club-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Codigo_club], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Codigo_club], [
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
            'Codigo_club',
            'Nombre',
            'Precio',
            'Precio_por_Noche',
            'Vigencia',
            'Desc_Afiliado',
            'Codigo_certificado',
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

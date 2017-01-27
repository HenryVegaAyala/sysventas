<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Codigo_Cliente',
            'Nombre',
            'Apellido',
            'Profesion',
            'Edad',
            // 'Estado_Civil',
            // 'Distrito',
            // 'Direccion',
            // 'Telefono_Casa',
            // 'Telefono_Celular',
            // 'Email:email',
            // 'Traslado',
            // 'Tarjeta_De_Credito',
            // 'Promotor',
            // 'Local',
            // 'Observacion',
            // 'Fecha_Creado',
            // 'Fecha_Modificado',
            // 'Fecha_Eliminado',
            // 'Usuario_Creado',
            // 'Usuario_Modificado',
            // 'Usuario_Eliminado',
            // 'Estado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

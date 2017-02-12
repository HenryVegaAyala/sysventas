<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AsigTlmkClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asig Tlmk Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asig-tlmk-cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asig Tlmk Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'Codigo_telemarketing',
            'Codigo_Cliente',
            'Fecha_Creada',
            'Fecha_Modificada',
            // 'Fecha_Eliminada',
            // 'Usuario_Creado',
            // 'Usuario_Modificado',
            // 'Usuario_Eliminado',
            // 'Fecha_Llamado',
            // 'Estado',
            // 'fecha_asignacion_codigo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

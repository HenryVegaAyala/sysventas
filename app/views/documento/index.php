<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Documento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Codigo_Documento',
            'Nombre',
            'archivo',
            'Fecha_Creado',
            'Fecha_Modificado',
            // 'Fecha_Eliminado',
            // 'Usuario_Creado',
            // 'Usuario_Eliminado',
            // 'Usuario_Modificado',
            // 'Estado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

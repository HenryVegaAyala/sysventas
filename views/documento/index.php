<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Documentos</h3>
    </div>
    <br>
    <div class="TableOculto">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'Nombre',
                    'archivo',
                    'Fecha_Creado',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
    <div class="panel-footer container-fluid foo">
    </div>
</div>
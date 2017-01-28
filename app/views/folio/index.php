<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FolioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Configuración';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Configuración</h3>
    </div>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'Descripcion',
                'Valor',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

    <div class="panel-footer container-fluid foo">
        <?= Html::a("<i class=\"fa fa-refresh\" aria-hidden=\"true\"></i> Refrescar", ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a("<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Nuevo Configuración", ['create'], ['class' => 'btn btn-primary']) ?>
    </div>

</div>
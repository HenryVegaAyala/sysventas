<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\PorcentajeComisionSearch $searchModel
 */

$this->title = 'Porcentaje de Comisiones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="porcentaje-comision-index">

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'Usuario',
                'label' => 'Usuario',
                'value' => function ($data) {
                    $model = new \app\models\Usuario();
                    $rol = $data->Usuario;
                    $valor = $model->getRol($rol);
                    return $valor;
                }
            ],

            'procentaje',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Opciones',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{update} </div>',
                'options' => ['style' => 'width:180px;'],
                'headerOptions' => ['class' => 'itemHide'],
                'contentOptions' => ['class' => 'itemHide'],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
//            'type' => 'info',
//            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]); Pjax::end(); ?>

</div>

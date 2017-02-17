<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\VentaSearch $searchModel
 */

$this->title = 'Lista de Ventas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venta-index">

    <?php Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'Codigo_Cliente',
                'label' => 'Datos Personales',
                'value' => function ($data) {
                    $model = new \app\models\Cliente();
                    $dato = $data->Codigo_Cliente;
                    $valor = $model->Cliente($dato);
                    return $valor;
                }
            ],
            [
                'attribute' => 'Codigo_club',
                'label' => 'Tipo de Club',
                'value' => function ($data) {
                    $model = new \app\models\Venta();
                    $estado = $data->Codigo_club;
                    $valor = $model->Club($estado);
                    return $valor;
                }
            ],
            [
                'attribute' => 'Codigo_pasaporte',
                'label' => 'Tipo de Pasaporte',
                'value' => function ($data) {
                    $model = new \app\models\Venta();
                    $estado = $data->Codigo_pasaporte;
                    $valor = $model->Pasaporte($estado);
                    return $valor;
                }
            ],
            [
                'attribute' => 'medio_pago',
                'label' => 'Medio de Pago',
                'value' => function ($data) {
                    $model = new \app\models\Venta();
                    $estado = $data->medio_pago;
                    $valor = $model->MedioDePago($estado);
                    return $valor;
                }
            ],
            [
                'attribute' => 'Estado_pago',
                'label' => 'Estado de Pago',
                'value' => function ($data) {
                    $model = new \app\models\Venta();
                    $estado = $data->Estado_pago;
                    $valor = $model->EstadoDePago($estado);
                    return $valor;
                }
            ],
            [
                'attribute' => 'porcentaje_pagado',
                'label' => 'Porcentaje Pagado',
                'value' => function ($data) {
                    return $data->porcentaje_pagado . ' %';
                }
            ],
            [
                'attribute' => 'Factura_emitida',
                'label' => 'Factura Emitida',
                'value' => function ($data) {
                    if ($data->Factura_emitida == 1) {
                        $data = 'Generado';
                    } else {
                        $data = 'No Generado';
                    }
                    return $data;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Opciones de Venta',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view} {contrato} {factura} {archivo}</div>',
                'options' => ['style' => 'width:130px;'],
                'headerOptions' => ['class' => 'itemHide'],
                'contentOptions' => ['class' => 'itemHide'],
                'buttons' => [
                    'contrato' => function ($url, $model) {
//                        return Html::a('<i class="fa fa-cogs"></i>', $url, ['title' => Yii::t('app', 'Eliminar'), 'class' => 'btn btn-default', 'data-confirm' => "Your confirmation message?", 'data-pjax' => '0']);
                        return Html::a('<span class="fa fa-cogs"></span>', $url, ['title' => Yii::t('app', 'Generar Contrato'),'target' => '_blank', 'class' => 'btn btn-default', 'data' => ['pjax' => 0]]);
                    },
//                    'factura' => function ($url, $model, $key) {
//                        return Html::a('<i class="fa fa-file-pdf-o"></i>', $url, ['title' => Yii::t('app', 'Generar Factura'),'target' => '_blank', 'class' => 'btn btn-default', 'data' => ['pjax' => 0]]);
//                    },

                    'archivo' => function ($url, $model) {
//                        return Html::a('<i class="fa fa-cloud-upload"></i>', ['archivo', 'id' => $model['Codigo_venta']], ['title' => Yii::t('app', 'Subir Archivo'), 'class' => 'btn btn-default', 'data' => ['pjax' => 0]]);
                        return Html::a('<i class="fa fa-cloud-upload"></i>', $url, ['title' => Yii::t('app', 'Subir Archivo'), 'class' => 'btn btn-default', 'data' => ['pjax' => 0]]);
                    },

                ],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
//        'floatHeader' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
//            'type' => 'info',
//            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Actualizar Lista', ['index'], ['class' => 'btn btn-primary']),
            'showFooter' => false
        ],
    ]);
    Pjax::end(); ?>

</div>

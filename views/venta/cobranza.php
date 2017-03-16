<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\VentaSearch $searchModel
 */

$this->title = 'Lista de Cobranza';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venta-index">

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'numero_contrato',
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
            'razon_social',
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
                'label' => 'N° de Pasaporte',
                'value' => function ($data) {
                    $model = new \app\models\Venta();
                    $Codigo = $data->Codigo_venta;
                    $valor = $model->NumeroPasaporte($Codigo, 1);
                    return strtoupper($valor);
                }
            ],
            [
                'attribute' => 'salas',
                'label' => 'Salas',
                'value' => function ($data) {
                    $model = new \app\models\Venta();
                    $salas = $data->salas;
                    $valor = $model->setgetSalas($salas);
                    return $valor;
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Cobranza',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{vista}</div>',
                'options' => ['style' => 'width:80px;'],
                'headerOptions' => ['class' => 'itemHide'],
                'contentOptions' => ['class' => 'itemHide'],
                'buttons' => [
                    'contrato' => function ($url, $model) {
//                        return Html::a('<i class="fa fa-cogs"></i>', $url, ['title' => Yii::t('app', 'Eliminar'), 'class' => 'btn btn-default', 'data-confirm' => "Your confirmation message?", 'data-pjax' => '0']);
                        return Html::a('<span class="fa fa-cogs"></span>', $url, ['title' => Yii::t('app', 'Generar Contrato'), 'target' => '_blank', 'class' => 'btn btn-default', 'data' => ['pjax' => 0]]);
                    },
//                    'factura' => function ($url, $model, $key) {
//                        return Html::a('<i class="fa fa-file-pdf-o"></i>', $url, ['title' => Yii::t('app', 'Generar Factura'),'target' => '_blank', 'class' => 'btn btn-default', 'data' => ['pjax' => 0]]);
//                    },
                    'vista' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['vista', 'id' => $model['Codigo_venta']], ['title' => Yii::t('app', 'Vista Detalle'), 'class' => 'btn btn-default', 'data' => ['pjax' => 0]]);},

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
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Actualizar Lista', ['cobranza'], ['class' => 'btn btn-primary']),
            'showFooter' => false
        ],
    ]);
    Pjax::end(); ?>

</div>
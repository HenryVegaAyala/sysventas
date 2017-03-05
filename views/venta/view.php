<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Venta;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */

$this->title = 'N° de Contrato: ' . $model->numero_contrato;
$venta = new Venta();
$pagos = new \app\models\Pago();
$clientes = new \app\models\Cliente();
?>
<div class="venta-view">

    <?php
    $attributes = [

        [
            'group' => true,
            'label' => 'DETALLE DE LA VENTA:',
            'rowOptions' => ['class' => 'info'],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'format' => 'raw',
                    'value' => "$model->razon_social",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'salas',
                    'format' => 'raw',
                    'value' => function () {
                        $venta = new Venta();
                        $salas = $venta->salas;
                        $valor = $venta->setgetSalas($salas);
                        return $valor;
                    },
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'serie_comprobante',
                    'format' => 'raw',
                    'value' => "$model->serie_comprobante",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'numero_comprobante',
                    'format' => 'raw',
                    'value' => "$model->numero_comprobante",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],


        ],

        [
            'group' => true,
            'label' => 'DATOS DEL CLIENTE',
            'rowOptions' => ['class' => 'info']
        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Nombre',
                    'format' => 'raw',
                    'value' => "$cliente->Nombre",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Apellido',
                    'format' => 'raw',
                    'value' => "$cliente->Apellido",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'dni',
                    'format' => 'raw',
                    'value' => "$cliente->dni",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Edad',
                    'format' => 'raw',
                    'value' => "$cliente->Edad",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Direccion',
                    'format' => 'raw',
                    'value' => "$cliente->Direccion",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Distrito',
                    'format' => 'raw',
                    'value' => "$cliente->Distrito",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Traslado',
                    'format' => 'raw',
                    'value' => $clientes->setTraslado($cliente->Traslado),
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Tipo de Tarjeta',
                    'format' => 'raw',
                    'value' => $clientes->setTarjeta($cliente->Tarjeta_De_Credito),
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Estado Civil',
                    'format' => 'raw',
                    'value' => $clientes->EstadoCivil($cliente->Estado_Civil),
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Profesion',
                    'format' => 'raw',
                    'value' => "$cliente->Profesion",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Telefono Casa',
                    'format' => 'raw',
                    'value' => "$cliente->Telefono_Casa",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Telefono Celular',
                    'format' => 'raw',
                    'value' => "$cliente->Telefono_Celular",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Email',
                    'format' => 'raw',
                    'value' => "$cliente->Email",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => '',
                    'format' => 'raw',
                    'value' => "",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],

        [
            'group' => true,
            'label' => 'PRODUCTO CONTRATADO',
            'rowOptions' => ['class' => 'info'],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Tipo de Club',
                    'format' => 'raw',
                    'value' => $venta->Club($model->Codigo_club),
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Tipo de Pasaporte',
                    'format' => 'raw',
                    'value' => $venta->TipoPasaporte($model->Codigo_pasaporte),
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'N° de Pasaporte',
                    'format' => 'raw',
                    'value' => strtoupper($model->NumeroPasaporte($model->Codigo_venta,1)),
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => '',
                    'format' => 'raw',
                    'value' => "",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],

        [
            'group' => true,
            'label' => 'INCENTIVOS',
            'rowOptions' => ['class' => 'info'],
            //'groupOptions'=>['class'=>'text-center']
        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Incentivos 1',
                    'format' => 'raw',
                    'value' => "$incentivos->convetidor1",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Incentivos 2',
                    'format' => 'raw',
                    'value' => "$incentivos->convetidor2",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Regalos',
                    'format' => 'raw',
                    'value' => "$incentivos->Regalos",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Observacion',
                    'format' => 'raw',
                    'value' => "$incentivos->Observacion",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],

        [
            'group' => true,
            'label' => 'FORMAS DE PAGO',
            'rowOptions' => ['class' => 'info'],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Tipo de Pago',
                    'format' => 'raw',
                    'value' => $pagos->getMedioDePago($pago->tipo_pago),
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Estado de Pago',
                    'format' => 'raw',
                    'value' => $pagos->getEstadoDePago($pago->estado_pago),
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Monto Total',
                    'format' => 'raw',
                    'value' => "$pago->monto_pagado",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Monto Ingresado',
                    'format' => 'raw',
                    'value' => "$pago->monto_ingresado",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        
        [
            'group' => true,
            'label' => 'COMISIONES',
            'rowOptions' => ['class' => 'info'],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Digitador',
                    'format' => 'raw',
                    'value' => "$comision->Digitador",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'OPC',
                    'format' => 'raw',
                    'value' => "$comision->OPC",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Tienda',
                    'format' => 'raw',
                    'value' => "$comision->Tienda",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Supervisor Promotor',
                    'format' => 'raw',
                    'value' => "$comision->SupervisorPromotor",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Supervior General OPC',
                    'format' => 'raw',
                    'value' => "$comision->SuperviorGeneralOPC",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Directorde Mercadero',
                    'format' => 'raw',
                    'value' => "$comision->DirectordeMercadero",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'TLMK',
                    'format' => 'raw',
                    'value' => "$comision->TLMK",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Supervisor de TLMK',
                    'format' => 'raw',
                    'value' => "$comision->SupervisordeTLMK",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Confirmadora',
                    'format' => 'raw',
                    'value' => "$comision->Confirmadora",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Director de TLMK',
                    'format' => 'raw',
                    'value' => "$comision->DirectordeTLMK",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Liner',
                    'format' => 'raw',
                    'value' => "$comision->Liner",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Closer',
                    'format' => 'raw',
                    'value' => "$comision->Closer",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Closer 2',
                    'format' => 'raw',
                    'value' => "$comision->Closer2",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Jefe de Sala',
                    'format' => 'raw',
                    'value' => "$comision->JefedeSala",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Director de Ventas',
                    'format' => 'raw',
                    'value' => "$comision->DirectordeVentas",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Director de Proyectos',
                    'format' => 'raw',
                    'value' => "$comision->DirectordeProyectos",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Generencia General',
                    'format' => 'raw',
                    'value' => "$comision->GenerenciaGeneral",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => 'Dir. de Planeamiento',
                    'format' => 'raw',
                    'value' => "$comision->directordePlaneamiento",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],
        [
            'columns' => [
                [
                    'attribute' => 'razon_social',
                    'label' => 'Asesor de Planeamiento',
                    'format' => 'raw',
                    'value' => "$comision->asesordePlaneamiento",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'razon_social',
                    'label' => '',
                    'format' => 'raw',
                    'value' => "",
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],

        ],

    ];
    ?>

    <div class="panel panel-default" xmlns="http://www.w3.org/1999/html">

        <div class="panel-heading">
            <h3 class="panel-title">
                <div class="pull-right">
                    <?= Html::a('<span class="fa fa-pencil fa-lg"></span>', ['update', 'id' => $model->Codigo_venta], ['title' => 'Actualizar', 'aria-label' => 'Actualizar', 'data-pjax' => '0']) ?>
                    |
                    <?= Html::a('<span class="fa fa-trash-o fa-lg"></span>', ['delete', 'id' => $model->Codigo_venta], ['title' => 'Eliminar', 'aria-label' => 'Eliminar', 'data-pjax' => '0', 'data' => ['confirm' => '¿Estas seguro de eliminar este Contrato?', 'method' => 'post',],]) ?>
                </div>
            </h3>
            <h3 class="panel-title"><strong><?= 'N° de Contrato: ' . strtoupper($model->numero_contrato) ?></strong>
            </h3>
        </div>

        <?= DetailView::widget([
            'model' => $model,

            'attributes' => $attributes,
            'mode' => 'view',
            'bordered' => 'bordered',
            'striped' => 'striped',
            'condensed' => 'condensed',
            'responsive' => 'responsive',
            'hover' => 'hover',
            'hAlign' => 'hAlign',
            'vAlign' => 'vAlign',
            'fadeDelay' => 'fadeDelay',
        ]) ?>
        <div class="panel-footer container-fluid foo">
            <p>
                <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Regresar", ['index'], ['class' => 'btn btn-primary']) ?>
            </p>
        </div>
    </div>
</div>

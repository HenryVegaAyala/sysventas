<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Venta */

$this->title = 'Detalle de la venta ';
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-view">

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?> </h3>
            </div>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
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
                ],
            ]) ?>
            <div class="panel-footer container-fluid foo">
                <p>
                    <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Regresar", ['index'], ['class' => 'btn btn-primary']) ?>
                </p>
            </div>
        </div>
    </div>
</div>
<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Cliente;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\AsigTlmkClienteSearch $searchModel
 */

$this->title = 'Lista de Clientes Asignados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asig-tlmk-cliente-index">

    <?php Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'Codigo_Cliente',
                'label' => 'Datos del Cliente',
                'value' => function ($data) {
                    $model = new Cliente();
                    $estado = $data->Codigo_Cliente;
                    $valor = $model->Cliente($estado);
                    return $valor;
                }
            ],

            [
                'attribute' => 'Codigo_Cliente',
                'label' => 'Edad',
                'value' => function ($data) {
                    $model = new Cliente();
                    $estado = $data->Codigo_Cliente;
                    $valor = $model->Datoscliente($estado, 0);
                    return $valor . ' años';
                }
            ],

            [
                'attribute' => 'Codigo_Cliente',
                'label' => 'Estado Civil',
                'value' => function ($data) {
                    $model = new Cliente();
                    $estado = $data->Codigo_Cliente;
                    $valor = $model->Datoscliente($estado, 1);
                    $estado1 = $model->EstadoCivil($valor);
                    return $estado1;
                }
            ],
//
            [
                'attribute' => 'Codigo_Cliente',
                'label' => 'Teléfono de Casa',
                'value' => function ($data) {
                    $model = new Cliente();
                    $estado = $data->Codigo_Cliente;
                    $valor = $model->Datoscliente($estado, 2);
                    return $valor;
                }
            ],
//
            [
                'attribute' => 'Codigo_Cliente',
                'label' => 'Teléfono de Casa',
                'value' => function ($data) {
                    $model = new Cliente();
                    $estado = $data->Codigo_Cliente;
                    $valor = $model->Datoscliente($estado, 3);
                    return $valor;
                }
            ],

            [
                'attribute' => 'Codigo_Cliente',
                'label' => 'Email',
                'value' => function ($data) {
                    $model = new Cliente();
                    $estado = $data->Codigo_Cliente;
                    $valor = $model->Datoscliente($estado, 4);
                    return $valor;
                }
            ],
            [
                'attribute' => 'Codigo_Cliente',
                'label' => 'Estado',
                'value' => function ($data) {
                    $model = new Cliente();
                    $modelo = new \app\models\Reporte();
                    $estado = $data->Codigo_Cliente;
                    $valor = $model->Datoscliente($estado, 5);
                    $Estado = $modelo->getEstadoNombre($valor);
                    return $Estado;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Detalle',
                'template' => '{view} ',
                'headerOptions' => ['class' => 'itemHide'],
                'contentOptions' => ['class' => 'itemHide'],
                'buttons' => [
                    'view' => function ($url, $model) {
                        $cliente = new Cliente();
                        $modelo = new \app\models\Reporte();
                        $estado = $model->Codigo_Cliente;
                        $valor = $cliente->Datoscliente($estado, 5);
                        if ($valor == 11){
                            return '';
                        }else{
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                                Yii::$app->urlManager->createUrl(['cliente/vista', 'id' => $model->Codigo_Cliente]),
                                ['title' => Yii::t('yii', 'Ver'),]
                            );
                        }
                    }
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


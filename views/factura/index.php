<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\FacturaSearch $searchModel
 */

$this->title = 'Facturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factura-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a('Create Factura', ['create'], ['class' => 'btn btn-success'])*/ ?>
    </p>

    <?php Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'attribute' => 'Fecha_Creado',
                'label' => 'Fecha Creada',
                'format' => ['date', 'php:d-m-Y'],
                'value' => 'Fecha_Creado'
            ],
            [
                'attribute' => 'Estado',
                'label' => 'Estado',
                'value' => function ($data) {
                    if ($data->Estado == 1) {
                        $data = 'Creado';
                    } else {
                        $data = 'Generado';
                    }
                    return $data;
                }
            ],
            [
                'attribute' => 'Codigo_Combo',
                'label' => 'Pasaporte',
                'value' => function ($data) {
                    $model = new \app\models\Producto();
                    $estado = $data->Codigo_Combo;
                    $valor = $model->Pasaporte($estado);
                    return $valor;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}  {update}  {delete} {factura}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'Vista Detallada'),]);
                    }
                ],
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'Actualizar Info'),]);
                    }
                ],
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model['id']], [
                            'title' => Yii::t('app', 'Eliminar'), 'data-confirm' => Yii::t('app', '¿Esta Seguro de eliminar este usuario?'), 'data-method' => 'post']);
                    }
                ],
                'buttons' => [
                    'factura' => function ($url, $model) {
                        return Html::a('<span class="fa fa-file-pdf-o"></span>', [$url], ['target' => '_blank', "data-pjax" => "0"]);
                    },
                ]
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
//            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Venta Nueva', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Refrescar Lista', ['index'], ['class' => 'btn btn-primary']),
            'showFooter' => false
        ],
    ]);
    Pjax::end(); ?>

</div>

<script>
    $('#reporte').attr('target', '_BLANK');
</script>
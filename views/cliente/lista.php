<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use app\models\Cliente;
use yii\helpers\ArrayHelper;
use app\models\Reporte;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\ClienteSearch $searchModel
 */

$this->title = 'Lista de Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <?php Pjax::begin();
    $model = new Cliente();
    $modelo = new Reporte();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Nombre',
                'label' => 'Datos Personales',
                'value' => function ($data) {
                    $dato = $data->Nombre . ' ' . $data->Apellido;
                    return $dato;
                }
            ],
            [
                'attribute' => 'Edad',
                'label' => 'Edad',
                'value' => function ($data) {
                    $dato = $data->Edad . ' años';
                    return $dato;
                }
            ],
            [
                'attribute' => 'Estado_Civil',
                'label' => 'Estado Civil',
                'filter' => $model->getEstadoCivil(),
                'value' => function ($data) {
                    $model = new Cliente();
                    $estado = $data->Estado_Civil;
                    $valor = $model->EstadoCivil($estado);
                    return $valor;
                }
            ],
            'Telefono_Celular',
            'Email:email',
            [
                'attribute' => 'Tarjeta_De_Credito',
                'label' => 'Tipo de tarjeta',
                'filter' => $model->getTarjeta(),
                'value' => function ($data) {
                    if ($data->Tarjeta_De_Credito == 0) {
                        $data = 'Tarjeta de Crédito';
                    } elseif ($data->Tarjeta_De_Credito == 1) {
                        $data = 'Tarjeta de Débito';
                    }else{
                        $data = '';
                    }
                    return $data;
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
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            Yii::$app->urlManager->createUrl(['cliente/view', 'id' => $model->Codigo_Cliente]),
                            ['title' => Yii::t('yii', 'Ver'),]
                        );
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
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Actualizar Lista', ['lista'], ['class' => 'btn btn-primary']),
            'showFooter' => false
        ],
    ]);
    Pjax::end(); ?>

</div>

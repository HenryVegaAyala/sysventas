<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use app\models\Cliente;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\ClienteSearch $searchModel
 */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <?php Pjax::begin();
    $model = new Cliente();
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
                    } else {
                        $data = 'Tarjeta de Débito';
                    }
                    return $data;
                }
            ],
            [
                'attribute' => 'Estado',
                'label' => 'Estado',
                'filter' => array("1" => "Confirmado", "2" => "No Confirmado"),
                'value' => function ($data) {
                    if ($data->Estado == 11) {
                        $data = 'Confirmado';
                    } else {
                        $data = '';
                    }
                    return $data;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Detalles',
                'template' => '{view} {confirmar}  {desafiliar} ',
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
                'buttons' => [
                    'confirmar' => function ($url, $model) {
                        return Html::a('<span class="fa fa-check-square"></span>',
                            Yii::$app->urlManager->createUrl(['cliente/confirmar', 'id' => $model->Codigo_Cliente]),
                            ['title' => Yii::t('yii', 'Confirmar Asistencia'),]
                        );
                    }
                ],
//                'buttons' => [
//                    'desafiliar' => function ($url, $model) {
//                        return Html::a('<span class="fa fa-times"></span>',
//                            Yii::$app->urlManager->createUrl(['cliente/desafiliar', 'id' => $model->Codigo_Cliente]),
//                            ['title' => Yii::t('yii', 'Desconfirmar Asistencia'),]
//                        );
//                    }
//                ],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
//            'type' => 'info',
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Actualizar Lista', ['confirmador'], ['class' => 'btn btn-primary']),
            'showFooter' => false
        ],
    ]);
    Pjax::end(); ?>

</div>

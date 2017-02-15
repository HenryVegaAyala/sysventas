<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use app\models\Cliente;

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
                'filter' => $model->getEstadoCivil(),
                'label' => 'Estado Civil',
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
                'filter' => $model->getTarjeta(),
                'label' => 'Tipo de tarjeta',
                'value' => function ($data) {
                    $model = new Cliente();
                    $estado = $data->Tarjeta_De_Credito;
                    $valor = $model->Tarjeta($estado);
                    return $valor;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Detalle',
                'template' => '{view} {update}  ',
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
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Yii::$app->urlManager->createUrl(['cliente/update', 'id' => $model->Codigo_Cliente]),
                            ['title' => Yii::t('yii', 'Actualizar'),]
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
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Actualizar Lista', ['index'], ['class' => 'btn btn-primary']),
            'showFooter' => false
        ],
    ]);
    Pjax::end(); ?>

</div>

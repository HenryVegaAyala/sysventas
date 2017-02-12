<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Button;
use yii\helpers\Url;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Documentos</h3>
    </div>
    <br>
    <div class="TableOculto">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'Nombre',
                    'archivo',
                    [
                        'attribute' => 'Fecha_Creado',
                        'value' => 'Fecha_Creado',
                        'format' => 'raw',
                        'options' => ['style' => 'width: 20%;'],
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'Fecha_Creado',
                            'options' => ['placeholder' => ''],
                            'pluginOptions' => [
                                'id' => 'Fecha_Creado',
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                                'startView' => 'year',
                            ]
                        ])
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Opciones',
                        'template' => '{contrato} ',
                        'headerOptions' => ['class' => 'itemHide'],
                        'contentOptions' => ['class' => 'itemHide'],
                        'template' => '{update} {delete} {descarga}',
                        'buttons' => [
                            'descarga' => function ($url, $model) {
                                return Html::a('<span class="fa fa-cloud-download"></span>',
                                    Yii::$app->urlManager->createUrl(['documento/descarga', 'id' => $model->Codigo_Documento]),
                                    ['title' => Yii::t('yii', 'descarga'),]
                                );
                            }
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
    <div class="panel-footer container-fluid foo">
    </div>
</div>
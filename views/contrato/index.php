<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Button;

$this->title = 'Contratos';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Contratos</h3>
    </div>

    <h4>
        <?php
        echo Button::widget([
            'label' => " Búsqueda Avanzada",
            'options' => ['class' => 'btn btn-link fa fa-search'],
        ]);
        ?>
    </h4>

    <div class="search-form">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
<br>
    <div class="TableOculto">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'Codigo_Contrato',
                    'Nombre',
                    'Apellidos',
                    'Dni_1',
                    'Estado_Civil_1',
                    'Ocupacion_1',
                    ['class' => 'yii\grid\ActionColumn','header'=>'Contrato','template'=>'{contrato} ',
                        'headerOptions' => ['class' => 'itemHide'],
                        'contentOptions' => ['class' => 'itemHide'],
                        'buttons'=>[
                            'contrato' => function ($url, $model) {
                                return Html::a('<span class="fa fa-file-pdf-o"></span>', $url, [
                                    'title' => Yii::t('app', 'contrato'),
                                    'data-confirm' => Yii::t('app', '¿Desea Generar el Contrato?'),
                                ]);
                            },
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\ClubSearch $searchModel
 */

$this->title = 'Lista de Club';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="club-index">
    <?php Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Nombre',
            'Precio',
            'Precio_por_Noche',
            'Vigencia',
            'Desc_Afiliado',
            'Codigo_certificado',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Detalle',
                'template' => '{view} {update}  ',
                'headerOptions' => ['class' => 'itemHide'],
                'contentOptions' => ['class' => 'itemHide'],
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Yii::$app->urlManager->createUrl(['club/update', 'id' => $model->Codigo_club]),
                            ['title' => Yii::t('yii', 'Actualizar'),]
                        );
                    }
                ],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
//            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar Club', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Actualizar Lista', ['index'], ['class' => 'btn btn-primary']),
            'showFooter' => false
        ],
    ]);
    Pjax::end(); ?>

</div>
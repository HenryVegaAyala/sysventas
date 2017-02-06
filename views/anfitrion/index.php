<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\AnfitrionSearch $searchModel
 */

$this->title = 'Lista de Anfitriones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anfitrion-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a('Create Anfitrion', ['create'], ['class' => 'btn btn-success'])*/ ?>
    </p>

    <?php Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
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
            'DNI',
            'Telefono_Celular',
            [
                'attribute' => 'Turno',
                'label' => 'Turno',
                'value' => function ($data) {
                    $model = new \app\models\Anfitrion();
                    $estado = $data->Turno;
                    $valor = $model->getTurnoView($estado);
                    return $valor;
                }
            ],
            [
                'attribute' => 'Descanso',
                'label' => 'Dia de Descanso',
                'value' => function ($data) {
                    $model = new \app\models\Anfitrion();
                    $estado = $data->Descanso;
                    $valor = $model->getDiaDescansoView($estado);
                    return $valor;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Yii::$app->urlManager->createUrl(['anfitrion/update', 'id' => $model->Codigo, 'edit' => 't']),
                            ['title' => Yii::t('yii', 'Edit'),]
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
//            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Refrescar Lista', ['index'], ['class' => 'btn btn-primary']),
            'showFooter' => false
        ],
    ]);
    Pjax::end(); ?>

</div>

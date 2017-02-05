<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Usuario;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\UsuarioSearch $searchModel
 */

$this->title = 'Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a('Create Usuario', ['create'], ['class' => 'btn btn-success'])*/ ?>
    </p>

    <?php Pjax::begin();
    echo GridView::widget(['dataProvider' => $dataProvider,
        'columns' => [['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            [
                'attribute' => 'Fecha_Creado',
                'label' => 'Fecha Creada',
                'format' => ['date', 'php:d-m-Y'],
                'value' => 'Fecha_Creado'
            ],
            [
                'attribute' => 'status',
                'label' => 'Estado',
                'value' => function ($data) {
                    if ($data->status = 1) {
                        $data = 'Activo';
                    } else {
                        $data = 'Inactivo';
                    }
                    return $data;
                }
            ],
            ['attribute' => 'Codigo_Rol',
                'label' => 'Rol',
                'value' => function ($data) {
                    $model = new Usuario();
                    $rol = $data->Codigo_Rol;
                    $valor = $model->getRol($rol);
                    return $valor;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}  {update}  {delete}',
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
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
//            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Agregar', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Refrescar Lista', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]);
    Pjax::end(); ?>

</div>

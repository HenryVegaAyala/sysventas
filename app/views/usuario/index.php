<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Usuario - Rol:     ';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Usuario</h3>
    </div>

    <h4>
        <?php
        echo Button::widget([
            'label' => " Búsqueda Avanzada",
            'options' => ['class' => 'btn btn-link fa fa-search', 'id' => 'BtnBuscarAvanzada'],
        ]);
        ?>
    </h4>

    <div class="search-form FormularioOculto">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'Nombre',
                'Apellido',
                'Email:email',
                [
                    'attribute' => 'Codigo_Rol',
                    'value' => function ($data) {
                        $variable = $data->__GET('Codigo_Rol');
                        $model = new \app\models\Rol();
                        $Rol = $model->getRol($variable);
                        return $Rol;
                    },
                    'contentOptions'=>['style'=>'max-width: 100px;']
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

    <div class="panel-footer container-fluid foo">
        <?= Html::a("<i class=\"fa fa-refresh\" aria-hidden=\"true\"></i> Refrescar", ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a("<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Nuevo Usuario", ['create'], ['class' => 'btn btn-primary']) ?>
    </div>

</div>
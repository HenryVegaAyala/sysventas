<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Productos</h3>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Nombre',
            'Precio',
            'Precio_por_Noche',
            [
                'attribute' => 'Vigencia',
                'label' => 'Vigencia',
                'value' => function ($data) {
                    if ($data->Vigencia > 1) {
                        return $data->Vigencia . ' años';
                    } else {
                        return $data->Vigencia . ' año';
                    }
                }
            ],
            [
                'attribute' => 'Desc_Afiliado',
                'label' => 'Descuento al Afiliado',
                'value' => function ($data) {
                    return $data->Desc_Afiliado . ' %';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <div class="panel-footer container-fluid foo">
    </div>
</div>

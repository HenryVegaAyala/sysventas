<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = 'Vista Detallada del Producto: ' . $model->Nombre;
?>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?> </h3>
        </div>

        <div class="producto-view">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

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
                ],
            ]) ?>

            <div class="panel-footer container-fluid foo">
                <p>
                    <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Regresar", ['index'], ['class' => 'btn btn-primary']) ?>
                </p>
            </div>
        </div>
    </div>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Cliente;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = 'Detalle del Cliente - ' . $model->Nombre . ' ' . $model->Apellido;
?>
<div class="cliente-view">

    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?> </h3>
            </div>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'Nombre',
                    'Apellido',
                    'Profesion',
                    [
                        'label' => 'Edad',
                        'value' => $model->Edad . ' años',
                    ],
                    [
                        'attribute' => 'Estado_Civil',
                        'value' => function ($data) {
                            $model = new Cliente();
                            $estado = $data->Estado_Civil;
                            $valor = $model->EstadoCivil($estado);
                            return $valor;
                        }
                    ],
                    'Distrito',
                    'Telefono_Casa',
                    'Telefono_Celular',
                    'Email:email',
                    [
                        'attribute' => 'Tarjeta_De_Credito',
                        'value' => function ($data) {
                            if ($data->Tarjeta_De_Credito == 0) {
                                $data = 'Tarjeta de Crédito';
                            } else {
                                $data = 'Tarjeta de Débito';
                            }
                            return $data;
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

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Anfitrion */

$this->title = 'Detalle del Anfitrion - ' . $model->Nombre . ' ' . $model->Apellido;

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
                    [
                        'label' => 'Nombre y Apellidos',
                        'value' => $model->Nombre . ' ' . $model->Apellido,
                    ],
                    'DNI',
                    [
                        'label' => 'Edad',
                        'value' => $model->Edad . ' años',
                    ],
                    'Cargo',
                    'Telefono_Casa',
                    'Telefono_Celular',
                    [
                        'attribute' => 'Turno',
                        'value' => function ($data) {
                            $model = new \app\models\Anfitrion();
                            $estado = $data->Turno;
                            $valor = $model->getTurnoView($estado);
                            return $valor;
                        }
                    ],
                    [
                        'attribute' => 'Dia de Descanso',
                        'value' => function ($data) {
                            $model = new \app\models\Anfitrion();
                            $estado = $data->Descanso;
                            $valor = $model->getDiaDescansoView($estado);
                            return $valor;
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
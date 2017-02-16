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
                    'dni',
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
                    'Direccion',
                    'Telefono_Casa',
                    'Telefono_Casa2',
                    'Telefono_Celular',
                    'Telefono_Celular2',
                    'Telefono_Celular3',
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
                    'Promotor',
                    'Super_Promotor',
                    'Jefe_Promotor',
                ],
            ]) ?>
            <div class="panel-footer container-fluid foo">
                <p>
                    <?php
                    $cliente = new Cliente();
                    $modelo = new \app\models\Reporte();
                    $estado = $model->Codigo_Cliente;
                    $valor = $cliente->Datoscliente($estado, 5);
                    ?>
                    <?php if (Yii::$app->user->identity->Codigo_Rol == 3) { ?>
                        <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Regresar", ['cliente/lista'], ['class' => 'btn btn-primary']) ?>
                    <?php } elseif (Yii::$app->user->identity->Codigo_Rol == 5) { ?>
                        <?php if ($valor == 11) { ?>
                             <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Regresar", ['asig-tlmk-cliente/index'], ['class' => 'btn btn-primary']) ?>
                        <?php } else { ?>
                            <?= Html::a("<i class=\"fa fa-address-book-o\" aria-hidden=\"true\"></i> Agendar", ['agendar', 'id' => $model->Codigo_Cliente], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Regresar", ['asig-tlmk-cliente/index'], ['class' => 'btn btn-primary']) ?>
                        <?php } ?>
                    <?php } else { ?>
                        <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Regresar", ['index'], ['class' => 'btn btn-primary']) ?>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>
</div>
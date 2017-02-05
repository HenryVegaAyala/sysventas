<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Factura */

$this->title = 'Vista Detallada de la Factura:' . $model->id;
?>
<div class="factura-view">
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?> </h3>
            </div>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'Codigo_Cliente',
                        'value' => function ($data) {
                            $model = new \app\models\Cliente();
                            $estado = $data->Codigo_Cliente;
                            $valor = $model->Cliente($estado);
                            return $valor;
                        }
                    ],
                    [
                        'attribute' => 'Fecha_Creado',
                        'format' => ['date', 'dd-MM-Y'],
                    ],
                    [
                        'attribute' => 'Codigo_Combo',
                        'value' => function ($data) {
                            $model = new \app\models\Producto();
                            $estado = $data->Codigo_Combo;
                            $valor = $model->Pasaporte($estado);
                            return $valor;
                        }
                    ],
                ],
            ]) ?>

            <div class="panel-footer container-fluid ">Productos Adicionales:</div>

            <?php
            echo '<table class="table table-hover table-bordered table-condensed table-striped">';
            echo '<tr>';
            echo '<th style="text-align: center;" class="col-md-2">Cantidad</th>';
            echo '<th style="text-align: center;" >Descripción</th>';
            echo '<th style="text-align: center;" class="col-md-1">Precio</th>';
            echo '<th style="text-align: center;" class="col-md-1">Total</th>';
            echo '</tr>';
            $sqlStatement = "SELECT * FROM d_factura WHERE factura =  '" . $model->id . "';";
            $connection = Yii::$app->db;
            $command = $connection->createCommand($sqlStatement);
            $reader = $command->query();
            while ($row1 = $reader->read()) {
                echo '<tr>';
                echo '<td>' . $row1['Cantidad'] . '</td>';
                echo '<td>' . $row1['Descripcion'] . '</td>';
                echo '<td>' . $row1['precio'] . '</td>';
                echo '<td>' . $row1['Total'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            ?>

            <div class="panel-footer container-fluid foo">
                <?= Html::a("<i class=\"fa fa-chevron-circle-left\" aria-hidden=\"true\"></i> Regresar", ['index'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>

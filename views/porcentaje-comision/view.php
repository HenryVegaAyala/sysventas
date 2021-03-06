<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PorcentajeComision */

$this->title = 'Vista Detalla de Comisión';
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
            'Usuario',
            'procentaje',
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
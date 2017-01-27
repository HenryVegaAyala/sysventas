<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'GROUP GyG ',
        'innerContainerOptions' => ['class' => ' full-wrapper relative clearfix'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [

            ['label' => 'Modulo Registro', 'items' => [
                ['label' => 'Registrar Cliente', 'url' => ['/cliente/create']],
                ['label' => 'Registrar Productos y Servicios', 'url' => '#'],
                ['label' => 'Registrar de Ventas', 'url' => '#'],
                ['label' => 'Registrar de Ingreso - Caja Efectivo', 'url' => '#'],
            ], 'visible' => !Yii::$app->user->isGuest],

            ['label' => 'Modulo Seguimiento', 'items' => [
                ['label' => 'Clientes potenciales', 'url' => '#'],
                ['label' => 'Fidelización', 'url' => '#'],
                ['label' => 'Comisiones', 'url' => '#'],
                ['label' => 'Supervisión', 'url' => '#'],
            ], 'visible' => !Yii::$app->user->isGuest],

            ['label' => 'Modulo Finanza', 'items' => [
                ['label' => 'Tesoreria y Cobranzas', 'url' => '#'],
                ['label' => 'Ciclo Comercial', 'url' => '#'],
                ['label' => 'Requisiones y Pedidos', 'url' => '#'],
            ], 'visible' => !Yii::$app->user->isGuest],

            ['label' => 'Reportes', 'items' => [
                ['label' => 'Reporte General', 'url' => '#'],
                ['label' => 'Contratos', 'url' => '#'],
                ['label' => 'Facturas', 'url' => '#'],
                ['label' => 'Documentos y Cotizaciones', 'url' => '#'],
            ], 'visible' => !Yii::$app->user->isGuest],

            ['label' => 'Modulo Usuario', 'items' => [
                ['label' => 'Registrar Usuario', 'url' => ['/usuario/index']],
            ], 'visible' => !Yii::$app->user->isGuest],

            ['label' => 'Administración', 'items' => [
                ['label' => 'Configuración', 'url' => ['/folio/index']],
            ], 'visible' => !Yii::$app->user->isGuest],

            Yii::$app->user->isGuest ? (
            ['label' => 'Iniciar Sesión', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '<i class="fa fa-user-times" aria-hidden="true"></i> Cerrar Sesión (' . Yii::$app->user->identity->Nombre .' '.Yii::$app->user->identity->Apellido . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <p class="text-center">&copy; <?= date('Y') ?> <?= Yii::powered() ?> Todos los derechos reservados.</p>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

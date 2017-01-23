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
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

//            ['label' => 'Submenu', 'items' => [
//                ['label' => 'Action', 'url' => '#'],
//                ['label' => 'Another action', 'url' => '#'],
//                ['label' => 'Something else here', 'url' => '#'],
//            ],
//            ],

            ['label' => '1', 'url' => ['/usuario/1'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '2', 'url' => ['/usuario/2'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '3', 'url' => ['/usuario/2'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '4', 'url' => ['/usuario/4'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '5', 'url' => ['/usuario/5'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '6', 'url' => ['/usuario/6'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '7', 'url' => ['/usuario/7'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '8', 'url' => ['/usuario/8'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '9', 'url' => ['/usuario/9'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '10', 'url' => ['/usuario/10'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '11', 'url' => ['/usuario/11'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '12', 'url' => ['/usuario/12'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '13', 'url' => ['/usuario/13'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '14', 'url' => ['/usuario/14'], 'visible' => !Yii::$app->user->isGuest],

            ['label' => 'Usuario', 'url' => ['/usuario/index'], 'visible' => !Yii::$app->user->isGuest],

//            ['label' => 'Home', 'url' => ['/site/index'],'visible'=>!Yii::$app->user->isGuest],
            Yii::$app->user->isGuest ? (
            ['label' => 'Iniciar Sesión', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Cerrar Sesión (' . Yii::$app->user->identity->Email . ')',
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

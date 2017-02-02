<?php
use mdm\admin\components\MenuHelper;
use yii\widgets\Menu;
use yii\helpers\Url;


$menu = MenuHelper::getAssignedMenu(Yii::$app->user->id);

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <ul class="sidebar-menu">
            <li class="header">
                <center>
                    <h4>Menú del Sistema</h4>
                </center>
            </li>
            <li>
                <a href="/yii/index.php/admin"><i class="fa fa-dashboard"></i> <span>Admin</span></a>
            </li>

            <?php foreach ($menu as $key => $submenu) { ?>
                <li>
                    <a href="<?= Url::to([$submenu["url"][0]]) ?> "
                       class="<?= @$submenu["fa"] ?> "><?= $submenu["label"] ?> </a>
                </li>
            <?php } ?>

            <!-- --><?php //dmstr\widgets\Menu::widget(
            //            [
            //                'options' => ['class' => 'sidebar-menu'],
            //                'items' => [
            //                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
            //                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
            //                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
            //                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
            //                    [
            //                        'label' => 'Same tools',
            //                        'icon' => 'fa fa-share',
            //                        'url' => '#',
            //                        'items' => [
            //                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
            //                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
            //                            [
            //                                'label' => 'Level One',
            //                                'icon' => 'fa fa-circle-o',
            //                                'url' => '#',
            //                                'items' => [
            //                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
            //                                    [
            //                                        'label' => 'Level Two',
            //                                        'icon' => 'fa fa-circle-o',
            //                                        'url' => '#',
            //                                        'items' => [
            //                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
            //                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
            //                                        ],
            //                                    ],
            //                                ],
            //                            ],
            //                        ],
            //                    ],
            //                ],
            //                ]
            //            ) ?>

    </section>

</aside>

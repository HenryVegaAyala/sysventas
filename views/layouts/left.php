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
            <?php foreach ($menu as $key => $submenu) { ?>
                <li>
                    <a href="<?= Url::to([$submenu["url"][0]]) ?> "
                       class="<?= @$submenu["fa"] ?> "><?= $submenu["label"] ?> </a>
                </li>
            <?php } ?>

    </section>

</aside>

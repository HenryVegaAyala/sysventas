<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <center>
        <strong>Copyright &copy; <?= date('Y') ?> Desarrollado con <a href="https://www.gaonawebhosting.com"
                                                                      target="_blank">Gaona Web Hosting</a>.</strong>
        Todos los derechos reservados.
    </center>
</footer>


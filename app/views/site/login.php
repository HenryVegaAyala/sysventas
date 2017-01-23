<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar Sesión';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login loginmodal-container">
    <h1>Ingrese a Tú cuenta</h1><br>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Usuario'])->label(false) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Contraseña'])->label(false) ?>

    <span>
      <?= $form->field($model, 'rememberMe')->checkbox(['template' => "<div class=\"col-lg-6\">{input} {label}</div>", 'class' => '' ]) ?>
    </span>

    <?= Html::submitButton('Iniciar Sesión', ['class' => 'login loginmodal-submit', 'name' => 'login']) ?>

    <?php ActiveForm::end(); ?>

</div>

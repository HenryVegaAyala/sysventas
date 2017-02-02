<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Iniciar Sesión - Sistema de Ventas y CRM');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="loginmodal-container">
    <h1>Ingrese a Tú cuenta</h1>
    <br>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'validateOnBlur' => false,
        'validateOnType' => false,
        'validateOnChange' => false,
    ]) ?>

    <?= $form->field($model, 'login', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1', 'autofocus' => true, 'placeholder' => 'Correo Electrónico']])->label(false); ?>

    <?= $form->field($model, 'password', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2', 'placeholder' => 'Contraseña']])->passwordInput()->label(false) ?>

    <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3']) ?>

    <?= Html::submitButton(Yii::t('user', 'Sign in'), ['class' => 'login loginmodal-submit', 'tabindex' => '4']) ?>

    <?php ActiveForm::end(); ?>
</div>


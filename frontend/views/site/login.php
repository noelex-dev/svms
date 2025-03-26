<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

?>
<div class="site-login" style="
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/school_2.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    flex-direction: column; /* Stack logo and form vertically */
">
    <img src="<?= Url::to('@web/Logo.jpg') ?>" alt="DEFEMNHS Logo" class="brand-image img-circle elevation-3" style="width: 150px; height: 150px; margin-bottom: 20px; border-radius: 50%; object-fit: cover;">
    <div class="row col-lg-3">
        <div class="col-lg-12" style="background-color: white; padding: 20px; border-radius: 8px;">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
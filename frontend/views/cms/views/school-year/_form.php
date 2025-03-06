<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="school-year-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'year_start')->textInput() ?>

    <?= $form->field($model, 'year_end')->textInput() ?>

    <?= $form->field($model, 'semester_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
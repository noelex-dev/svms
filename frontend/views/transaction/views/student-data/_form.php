<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="student-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'personal_information_id')->textInput() ?>

    <?= $form->field($model, 'student_information_id')->textInput() ?>

    <?= $form->field($model, 'guardian_id')->textInput() ?>

    <?= $form->field($model, 'student_plan_id')->textInput() ?>

    <?= $form->field($model, 'grade_level_id')->textInput() ?>

    <?= $form->field($model, 'section_id')->textInput() ?>

    <?= $form->field($model, 'strand_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="student-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'personal_information_id') ?>

    <?= $form->field($model, 'student_information_id') ?>

    <?= $form->field($model, 'guardian_id') ?>

    <?= $form->field($model, 'student_plan_id') ?>

    <?php // echo $form->field($model, 'grade_level_id') 
    ?>

    <?php // echo $form->field($model, 'section_id') 
    ?>

    <?php // echo $form->field($model, 'strand_id') 
    ?>

    <?php // echo $form->field($model, 'created_at') 
    ?>

    <?php // echo $form->field($model, 'updated_at') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
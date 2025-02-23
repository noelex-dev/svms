<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\TeacherAdvisoryAssignment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="teacher-advisory-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

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

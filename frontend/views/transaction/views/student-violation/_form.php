<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\StudentViolation $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-violation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_data_id')->textInput() ?>

    <?= $form->field($model, 'violation_id')->textInput() ?>

    <?= $form->field($model, 'notification_status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

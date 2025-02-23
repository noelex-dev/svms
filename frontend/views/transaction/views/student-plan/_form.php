<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\StudentPlan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'elementary')->textInput() ?>

    <?= $form->field($model, 'secondary')->textInput() ?>

    <?= $form->field($model, 'college')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

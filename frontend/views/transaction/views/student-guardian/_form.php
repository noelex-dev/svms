<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\StudentGuardian $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-guardian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'personal_information_id')->textInput() ?>

    <?= $form->field($model, 'relationship_id')->textInput() ?>

    <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

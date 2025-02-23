<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\StudentInformation $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-information-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'early_disease')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'serious_accident')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hobby')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'special_talent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'easy_subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hard_subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, '4ps_status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

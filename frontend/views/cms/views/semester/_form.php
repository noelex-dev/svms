<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'semester-form',
    'enableAjaxValidation' => false,
]);
?>

<div class="modal-body" style="padding: 0px;">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
</div>

<div class="modal-footer" style="border-top: 0; margin: 0; padding: 0;">
    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-primary px-5 bg-maroon', 'style' => 'margin: 0; border: 0;']) ?>
</div>

<?php ActiveForm::end(); ?>
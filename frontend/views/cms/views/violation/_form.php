<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'violation-form',
    'enableAjaxValidation' => false,
]);
?>
<div class="modal-body" style="padding: 0;">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'violation_type_id')->textInput() ?>
</div>

<div class="modal-footer" style="border-top: 0; margin: 0; padding: 0;">
    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-primary px-5 bg-maroon', 'style' => 'margin: 0; border: 0;']) ?>
</div>

<?php ActiveForm::end(); ?>
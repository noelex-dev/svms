<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'grade-level-form',
    'enableAjaxValidation' => false,
]);
?>
<div class="modal-body" style="padding-bottom: 0px;">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
</div>

<div class="modal-footer" style="border-top: 0; margin: 0; padding: 0;">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary bg-maroon', 'style' => 'margin: 0; border: 0;']) ?>
</div>

<?php ActiveForm::end(); ?>
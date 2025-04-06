<?php

use kartik\daterange\DateRangePicker;
use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>

<div class="modal-body" style="padding: 0px;">
    <?php $form = ActiveForm::begin([
        'id' => 'school-year-form',
        'enableAjaxValidation' => false,
    ]); ?>

    <?= $form->field($model, 'date_range')->widget(DateRangePicker::classname(), [
        'options' => ['placeholder' => 'Select start & end of school year ...'],
        'pluginOptions' => [
            'convertFormat' => true,
            'useCurrent' => false,
            'allowClear' => true,
            'displayFormat' => 'F j, Y',
        ],
    ]) ?>

    <div class="modal-footer" style="border-top: 0; margin: 0; padding: 0;">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-primary px-5 bg-maroon', 'style' => 'margin: 0; border: 0;']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
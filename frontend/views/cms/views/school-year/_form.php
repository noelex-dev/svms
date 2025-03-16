<?php

use common\models\Semester;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'school-year-form',
    'enableAjaxValidation' => false,
]);
?>

<div class="modal-body" style="padding: 0px;">
    <?= $form->field($model, 'date_range')->widget(DateRangePicker::classname(), [
        'options' => ['placeholder' => 'Select start & end of school year ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'convertFormat' => true,
            'useCurrent' => false,
            'allowClear' => true,
            'displayFormat' => 'F j, Y',
        ],
    ]) ?>

    <?= $form->field($model, 'semester_id')->widget(Select2::classname(), [
        'data' => Semester::getDropdownData(),
        'options' => ['placeholder' => 'Select a semester ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
</div>

<div class="modal-footer" style="border-top: 0; margin: 0; padding: 0;">
    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-primary px-5 bg-maroon', 'style' => 'margin: 0; border: 0;']) ?>
</div>

<?php ActiveForm::end(); ?>
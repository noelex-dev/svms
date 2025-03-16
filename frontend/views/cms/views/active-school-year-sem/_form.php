<?php

use common\models\ActiveSchoolYearSem;
use common\models\SchoolYear;
use common\models\Semester;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'school-year-form',
    'enableAjaxValidation' => false,
]);
?>


<div class="modal-body" style="padding: 0px;">

    <?php
    $dropdownData = \common\models\ActiveSchoolYearSem::getDropdownData();

    if (empty($dropdownData) && !$model->isNewRecord) {
        $dropdownData = [$model->school_year_id => $model->schoolYear->name];
    }

    if (empty($dropdownData)) {
        echo $form->field($model, 'school_year_id')->widget(Select2::classname(), [
            'data' => [],
            'options' => [
                'placeholder' => 'No available school years',
                'disabled' => true,
            ],
            'pluginOptions' => [
                'allowClear' => false,
            ],
        ]);
    } else {
        echo $form->field($model, 'school_year_id')->widget(Select2::classname(), [
            'data' => $dropdownData,
            'options' => ['placeholder' => 'Select a school-year ...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);
    }
    ?>

    <?= $form->field($model, 'semester_id')->widget(Select2::classname(), [
        'data' => Semester::getDropdownData(),
        'options' => ['placeholder' => 'Select a semester ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'is_active')->widget(Select2::classname(), [
        'data' => [
            1 => 'Active',
            0 => 'Inactive',
        ],
        'options' => ['placeholder' => 'Select status ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>
</div>

<div class="modal-footer" style="border-top: 0; margin: 0; padding: 0;">
    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-primary px-5 bg-maroon', 'style' => 'margin: 0; border: 0;']) ?>
</div>

<?php ActiveForm::end(); ?>
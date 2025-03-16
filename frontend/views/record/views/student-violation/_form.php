<?php

use common\models\GradeLevel;
use common\models\SchoolYear;
use common\models\Section;
use common\models\Strand;
use common\models\StudentData;
use common\models\Violation;
use common\models\ViolationType;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

?>

<div class="student-violation-form">

    <?php $form = ActiveForm::begin(); ?>

    <label class="control-label text-muted">Filter Student</label>
    <div class="row mb-3">
        <div class="col-md-3">
            <label class="control-label">School Year</label>
            <?= Select2::widget([
                'name' => 'schoolYearDropdown',
                'id' => 'schoolYearDropdown',
                'data' => SchoolYear::getDropdownData(),
                'value' => $model->studentData->school_year_id ?? null, // PRE-FILL VALUE
                'options' => ['placeholder' => 'Filter by school year ...'],
                'pluginOptions' => ['allowClear' => true],
            ]); ?>
        </div>
        <div class="col-md-3">
            <label class="control-label">Grade</label>
            <?= Select2::widget([
                'name' => 'gradeDropdown',
                'id' => 'gradeDropdown',
                'data' => GradeLevel::getDropdownData(),
                'value' => $model->studentData->grade_level_id ?? null, // PRE-FILL VALUE
                'options' => ['placeholder' => 'Filter by grade ...'],
                'pluginOptions' => ['allowClear' => true],
            ]); ?>
        </div>
        <div class="col-md-3">
            <label class="control-label">Strand</label>
            <?= Select2::widget([
                'name' => 'strandDropdown',
                'id' => 'strandDropdown',
                'data' => Strand::getDropdownData(),
                'value' => $model->studentData->strand_id ?? null, // PRE-FILL VALUE
                'options' => ['placeholder' => 'Filter by strand ...'],
                'pluginOptions' => ['allowClear' => true],
            ]); ?>
        </div>
        <div class="col-md-3">
            <label class="control-label">Section</label>
            <?= Select2::widget([
                'name' => 'sectionDropdown',
                'id' => 'sectionDropdown',
                'data' => Section::getDropdownData(),
                'value' => $model->studentData->section_id ?? null, // PRE-FILL VALUE
                'options' => ['placeholder' => 'Filter by section ...'],
                'pluginOptions' => ['allowClear' => true],
            ]); ?>
        </div>
    </div>

    <?= $form->field($model, 'student_data_id')->widget(DepDrop::classname(), [
        'options' => [
            'id' => 'studentDataId',
            'placeholder' => 'Select a student ...',
        ],
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => ['schoolYearDropdown', 'gradeDropdown', 'strandDropdown', 'sectionDropdown'],
            'url' => Url::to(['/record/student-violation/get-student-list']),
            'loadingText' => 'Loading students ...',
            'initialize' => true,  // Ensure preselected value loads
            'params' => ['studentDataId'],
        ],
    ])->label('Student Name') ?>

    <label class="control-label text-muted">Violation</label>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="control-label">Violation Type</label>
            <?= Select2::widget([
                'name' => 'violationType',
                'id' => 'violationTypeDropdown',
                'data' => ViolationType::getDropdownData(),
                'value' => $model->violation->violation_type_id ?? null, // Pre-fill value
                'options' => ['placeholder' => 'Filter by violation type ...'],
                'pluginOptions' => ['allowClear' => true],
            ]); ?>

        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'violation_id')->widget(DepDrop::classname(), [
                'type' => DepDrop::TYPE_SELECT2,
                'options' => [
                    'id' => 'violationDropdown',
                    'placeholder' => 'Select a violation ...',
                ],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['violationTypeDropdown'],
                    'url' => Url::to(['/record/student-violation/get-violations-by-type']),
                    'loadingText' => 'Loading violations ...',
                    'initialize' => true, // Ensure value is preselected
                    'params' => ['violationDropdown'],
                ],
            ])->label('Violation') ?>

        </div>
    </div>

    <?= $form->field($model, 'notification_status')->widget(Select2::classname(), [
        'data' => [
            1 => 'Notify Guardian',
            0 => 'Do not Notify Guardian',
        ],
        'size' => Select2::MEDIUM,
        'options' => ['placeholder' => 'Select notify status...'],
        'pluginOptions' => ['allowClear' => true],
        'value' => $model->notification_status, // PRE-FILL VALUE
    ]) ?>

    <div class="modal-footer" style="border-top: 0; margin: 0; padding: 0;">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-primary px-5 bg-maroon', 'style' => 'margin: 0; border: 0;']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
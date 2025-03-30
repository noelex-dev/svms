<?php

use common\models\ActiveSchoolYearSem;
use common\models\GradeLevel;
use common\models\Relationship;
use common\models\SchoolYear;
use common\models\Section;
use common\models\Strand;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'student-data-form',
    'enableAjaxValidation' => false,
]);
?>

<div class="modal-body" style="padding: 0px;">
    <div>
        <div class="card mb-5">
            <div class="card-header">
                <i class="fas fa-user-tag"></i> Student's Class Details
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <?= $form->field($studentDataModel, 'school_year_id')->widget(Select2::classname(), [
                            'name' => 'studentDataSchoolYear',
                            'data' => SchoolYear::getDropdownData(),
                            'size' => Select2::SMALL,
                            'options' => ['placeholder' => 'Select grade level ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentDataModel, 'grade_level_id')->widget(Select2::classname(), [
                            'name' => 'studentDataGradeLevel',
                            'data' => GradeLevel::getDropdownData(),
                            'size' => Select2::SMALL,
                            'options' => ['placeholder' => 'Select grade level ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentDataModel, 'strand_id')->widget(Select2::classname(), [
                            'name' => 'studentDataStrand',
                            'data' => Strand::getDropdownData(),
                            'size' => Select2::SMALL,
                            'options' => ['placeholder' => 'Select strand ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentDataModel, 'section_id')->widget(Select2::classname(), [
                            'data' => Section::getDropdownData(),
                            'size' => Select2::SMALL,
                            'options' => ['placeholder' => 'Select section ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <i class="fas fa-user"></i> Student's Personal Information
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group col-md-3 p-0">
                            <?= $form->field($studentDataModel, 'lrn')->textInput([
                                'name' => 'StudentData[lrn]',
                                'maxlength' => true,
                                'class' => 'form-control form-control-sm'
                            ]) ?>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentPersonalInformationModel, 'first_name')->textInput([
                            'name' => 'StudentPersonalInformation[first_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentPersonalInformationModel, 'middle_name')->textInput([
                            'name' => 'StudentPersonalInformation[middle_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentPersonalInformationModel, 'last_name')->textInput([
                            'name' => 'StudentPersonalInformation[last_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentPersonalInformationModel, 'ext_name')->textInput([
                            'name' => 'StudentPersonalInformation[ext_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentPersonalInformationModel, 'birthdate')->input('date', [
                            'name' => 'StudentPersonalInformation[birthdate]',
                            'class' => 'form-control form-control-sm',
                        ]) ?>
                    </div>
                    <div class="form-group col-md-5">
                        <?= $form->field($studentPersonalInformationModel, 'birthplace')->textInput([
                            'name' => 'StudentPersonalInformation[birthplace]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($studentInformationModel, 'height')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($studentInformationModel, 'weight')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentInformationModel, 'language')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentInformationModel, 'hobby')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentInformationModel, 'special_talent')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentInformationModel, 'four_p_status')->widget(Select2::classname(), [
                            'data' => [
                                1 => 'Member',
                                0 => 'Not a member',
                            ],
                            'size' => Select2::SMALL,
                            'options' => ['placeholder' => 'Select 4Ps Status ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                            'value' => $studentInformationModel->isNewRecord ? null : ($studentInformationModel->getAttribute('four_p_status') ? 1 : 0),
                        ]) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $form->field($studentInformationModel, 'easy_subject')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $form->field($studentInformationModel, 'hard_subject')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $form->field($studentInformationModel, 'early_disease')->textarea(['rows' => 6]) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $form->field($studentInformationModel, 'serious_accident')->textarea(['rows' => 6]) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <i class="fas fa-user-group"></i> Guardian Information
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <?= $form->field($guardianPersonalInformationModel, 'first_name')->textInput([
                            'name' => 'GuardianPersonalInformation[first_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($guardianPersonalInformationModel, 'middle_name')->textInput([
                            'name' => 'GuardianPersonalInformation[middle_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($guardianPersonalInformationModel, 'last_name')->textInput([
                            'name' => 'GuardianPersonalInformation[last_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($guardianPersonalInformationModel, 'ext_name')->textInput([
                            'name' => 'GuardianPersonalInformation[ext_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                    </div>
                    <div class="form-group col-md-4">
                        <?= $form->field($studentGuardianModel, 'relationship_id')->widget(Select2::classname(), [
                            'data' => Relationship::getDropdownData(),
                            'size' => Select2::SMALL,
                            'options' => ['placeholder' => 'Select section ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                    </div>
                    <div class="form-group col-md-4">
                        <?= $form->field($studentGuardianModel, 'contact_number')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
                    </div>
                    <div class="form-group col-md-4">
                        <?= $form->field($studentGuardianModel, 'occupation')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <i class="fas fa-list-check"></i> Student Plan
            </div>
            <div class="card-body">
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-2">
                        <?= $form->field($studentPlanModel, 'higher_education')->checkbox() ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($studentPlanModel, 'employment')->checkbox() ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($studentPlanModel, 'entrepreneurship')->checkbox() ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($studentPlanModel, 'tesda')->checkbox() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer" style="border-top: 0; margin: 0; padding: 0;">
    <?= Html::submitButton($studentDataModel->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-primary px-5 bg-maroon', 'style' => 'margin: 0; border: 0;']) ?>
</div>

<?php ActiveForm::end(); ?>
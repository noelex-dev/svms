<?php

use common\models\ActiveSchoolYearSem;
use common\models\GradeLevel;
use common\models\Relationship;
use common\models\Section;
use common\models\Strand;
use common\models\User;
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
        <div class="card mb-3">
            <div class="card-header" style="background-color: #E5E7EB;">
                <i class="fas fa-user-tag"></i> Student's Class Details
            </div>
            <div class="card-body">
                <div class="form-group col-md-8 p-0">
                    <?php
                    $adviser = User::findOne($studentDataModel->adviser_id);
                    $adviserFullName = $adviser ? $adviser->personalInformation->fullName : '';
                    ?>
                    <?= $form->field($studentDataModel, 'adviser_id')->textInput([
                        'disabled' => true,
                        'value' => $adviserFullName,
                        'class' => 'form-control form-control-sm'
                    ]) ?>
                    <?= Html::hiddenInput('StudentData[adviser_id]', $studentDataModel->adviser_id) ?>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <?= $form->field($studentDataModel, 'school_year_id')->widget(Select2::classname(), [
                            'data' => ActiveSchoolYearSem::getActiveSchoolYearDropdown(),
                            'size' => Select2::SMALL,
                            'options' => [
                                'disabled' => true,
                            ],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                        ]) ?>
                        <?= Html::hiddenInput('StudentData[school_year_id]', $studentDataModel->school_year_id) ?>
                    </div>

                    <div class="form-group col-md-3">
                        <?= $form->field($studentDataModel, 'grade_level_id')->widget(Select2::classname(), [
                            'name' => 'studentDataGradeLevel',
                            'data' => GradeLevel::getDropdownData(),
                            'size' => Select2::SMALL,
                            'options' => [
                                'disabled' => true,
                            ],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                        ]) ?>
                        <?= Html::hiddenInput('StudentData[grade_level_id]', $studentDataModel->grade_level_id) ?>
                    </div>

                    <div class="form-group col-md-3">
                        <?= $form->field($studentDataModel, 'strand_id')->widget(Select2::classname(), [
                            'name' => 'studentDataStrand',
                            'data' => Strand::getDropdownData(),
                            'size' => Select2::SMALL,
                            'options' => [
                                'disabled' => true,
                            ],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                        ]) ?>
                        <?= Html::hiddenInput('StudentData[strand_id]', $studentDataModel->strand_id) ?>
                    </div>

                    <div class="form-group col-md-3">
                        <?= $form->field($studentDataModel, 'section_id')->widget(Select2::classname(), [
                            'data' => Section::getDropdownData(),
                            'size' => Select2::SMALL,
                            'options' => [
                                'disabled' => true,
                            ],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                        ]) ?>
                        <?= Html::hiddenInput('StudentData[section_id]', $studentDataModel->section_id) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header" style="background-color: #E5E7EB;">
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
                            ])->label($studentDataModel->getAttributeLabel('lrn') . ($studentDataModel->isAttributeRequired('lrn') ? ' <span class="required">*</span>' : '')) ?>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentPersonalInformationModel, 'first_name')->textInput([
                            'name' => 'StudentPersonalInformation[first_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ])->label($studentPersonalInformationModel->getAttributeLabel('first_name') . ($studentPersonalInformationModel->isAttributeRequired('first_name') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentPersonalInformationModel, 'middle_name')->textInput([
                            'name' => 'StudentPersonalInformation[middle_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ])->label($studentPersonalInformationModel->getAttributeLabel('middle_name') . ($studentPersonalInformationModel->isAttributeRequired('middle_name') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentPersonalInformationModel, 'last_name')->textInput([
                            'name' => 'StudentPersonalInformation[last_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ])->label($studentPersonalInformationModel->getAttributeLabel('last_name') . ($studentPersonalInformationModel->isAttributeRequired('last_name') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentPersonalInformationModel, 'ext_name')->textInput([
                            'name' => 'StudentPersonalInformation[ext_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ])->label($studentPersonalInformationModel->getAttributeLabel('ext_name') . ($studentPersonalInformationModel->isAttributeRequired('ext_name') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentPersonalInformationModel, 'birthdate')->input('date', [
                            'name' => 'StudentPersonalInformation[birthdate]',
                            'class' => 'form-control form-control-sm',
                        ])->label($studentPersonalInformationModel->getAttributeLabel('birthdate') . ($studentPersonalInformationModel->isAttributeRequired('birthdate') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-5">
                        <?= $form->field($studentPersonalInformationModel, 'birthplace')->textInput([
                            'name' => 'StudentPersonalInformation[birthplace]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ])->label($studentPersonalInformationModel->getAttributeLabel('birthplace') . ($studentPersonalInformationModel->isAttributeRequired('birthplace') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($studentInformationModel, 'height')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm'])->label($studentInformationModel->getAttributeLabel('height') . ($studentInformationModel->isAttributeRequired('height') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($studentInformationModel, 'weight')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm'])->label($studentInformationModel->getAttributeLabel('weight') . ($studentInformationModel->isAttributeRequired('weight') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentInformationModel, 'language')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm'])->label($studentInformationModel->getAttributeLabel('language') . ($studentInformationModel->isAttributeRequired('language') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentInformationModel, 'hobby')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm'])->label($studentInformationModel->getAttributeLabel('hobby') . ($studentInformationModel->isAttributeRequired('hobby') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($studentInformationModel, 'special_talent')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm'])->label($studentInformationModel->getAttributeLabel('special_talent') . ($studentInformationModel->isAttributeRequired('special_talent') ? ' <span class="required">*</span>' : '')) ?>
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
                        ])->label($studentInformationModel->getAttributeLabel('four_p_status') . ($studentInformationModel->isAttributeRequired('four_p_status') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $form->field($studentInformationModel, 'easy_subject')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm'])->label($studentInformationModel->getAttributeLabel('easy_subject') . ($studentInformationModel->isAttributeRequired('easy_subject') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $form->field($studentInformationModel, 'hard_subject')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm'])->label($studentInformationModel->getAttributeLabel('hard_subject') . ($studentInformationModel->isAttributeRequired('hard_subject') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $form->field($studentInformationModel, 'early_disease')->textarea(['rows' => 6])->label($studentInformationModel->getAttributeLabel('early_disease') . ($studentInformationModel->isAttributeRequired('early_disease') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $form->field($studentInformationModel, 'serious_accident')->textarea(['rows' => 6])->label($studentInformationModel->getAttributeLabel('serious_accident') . ($studentInformationModel->isAttributeRequired('serious_accident') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header" style="background-color: #E5E7EB;">
                <i class="fas fa-user-group"></i> Guardian Information
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <?= $form->field($guardianPersonalInformationModel, 'first_name')->textInput([
                            'name' => 'GuardianPersonalInformation[first_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ])->label($guardianPersonalInformationModel->getAttributeLabel('first_name') . ($guardianPersonalInformationModel->isAttributeRequired('first_name') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($guardianPersonalInformationModel, 'middle_name')->textInput([
                            'name' => 'GuardianPersonalInformation[middle_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ])->label($guardianPersonalInformationModel->getAttributeLabel('middle_name') . ($guardianPersonalInformationModel->isAttributeRequired('middle_name') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($guardianPersonalInformationModel, 'last_name')->textInput([
                            'name' => 'GuardianPersonalInformation[last_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ])->label($guardianPersonalInformationModel->getAttributeLabel('last_name') . ($guardianPersonalInformationModel->isAttributeRequired('last_name') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?= $form->field($guardianPersonalInformationModel, 'ext_name')->textInput([
                            'name' => 'GuardianPersonalInformation[ext_name]',
                            'maxlength' => true,
                            'class' => 'form-control form-control-sm'
                        ])->label($guardianPersonalInformationModel->getAttributeLabel('ext_name') . ($guardianPersonalInformationModel->isAttributeRequired('ext_name') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-4">
                        <?= $form->field($studentGuardianModel, 'relationship_id')->widget(Select2::classname(), [
                            'data' => Relationship::getDropdownData(),
                            'size' => Select2::SMALL,
                            'options' => ['placeholder' => 'Select section ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label($studentGuardianModel->getAttributeLabel('relationship_id') . ($studentGuardianModel->isAttributeRequired('relationship_id') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-4">
                        <?= $form->field($studentGuardianModel, 'contact_number')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm'])->label($studentGuardianModel->getAttributeLabel('contact_number') . ($studentGuardianModel->isAttributeRequired('contact_number') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                    <div class="form-group col-md-4">
                        <?= $form->field($studentGuardianModel, 'occupation')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm'])->label($studentGuardianModel->getAttributeLabel('occupation') . ($studentGuardianModel->isAttributeRequired('occupation') ? ' <span class="required">*</span>' : '')) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header" style="background-color: #E5E7EB;">
                <i class="fas fa-list-check"></i> Student Plan
            </div>
            <div class="card-body">
                <div class="form-row d-flex justify-content-around">
                    <div class="form-group col-md-2">
                        <?= $form->field($studentPlanModel, 'higher_education')->checkbox()->label(
                            $studentPlanModel->getAttributeLabel('higher_education') . ($studentPlanModel->isAttributeRequired('higher_education') ? ' <span class="required">*</span>' : '')
                        ) ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($studentPlanModel, 'employment')->checkbox()->label(
                            $studentPlanModel->getAttributeLabel('employment') . ($studentPlanModel->isAttributeRequired('employment') ? ' <span class="required">*</span>' : '')
                        ) ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($studentPlanModel, 'entrepreneurship')->checkbox()->label(
                            $studentPlanModel->getAttributeLabel('entrepreneurship') . ($studentPlanModel->isAttributeRequired('entrepreneurship') ? ' <span class="required">*</span>' : '')
                        ) ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($studentPlanModel, 'tesda')->checkbox()->label(
                            $studentPlanModel->getAttributeLabel('tesda') . ($studentPlanModel->isAttributeRequired('tesda') ? ' <span class="required">*</span>' : '')
                        ) ?>
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

<style>
    span.required {
        color: #dc3545 !important;
        font-weight: bold;
        display: inline;
        padding-left: 2px;
    }
</style>
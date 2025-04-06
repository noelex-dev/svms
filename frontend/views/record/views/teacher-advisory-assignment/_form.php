<?php

use common\models\ActiveSchoolYearSem;
use common\models\GradeLevel;
use common\models\Section;
use common\models\Strand;
use common\models\User;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>

<div class="modal-body" style="padding: 0px;">
    <?php $form = ActiveForm::begin([
        'id' => 'school-year-form',
        'enableAjaxValidation' => false,
    ]); ?>

    <?= $form->field($model, 'school_year_id')->widget(Select2::classname(), [
        'data' => ActiveSchoolYearSem::getActiveSchoolYearDropdown(),
        'size' => Select2::SMALL,
        'options' => [
            'disabled' => true,
        ],
        'pluginOptions' => [
            'allowClear' => false
        ],
    ])->label($model->getAttributeLabel('school_year_id') . ($model->isAttributeRequired('school_year_id') ? ' <span class="required">*</span>' : '')) ?>

    <?= Html::hiddenInput('StudentData[school_year_id]', $model->school_year_id) ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => User::getDropdownData(),
        'size' => Select2::SMALL,
        'options' => ['placeholder' => 'Select user ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label($model->getAttributeLabel('user_id') . ($model->isAttributeRequired('user_id') ? ' <span class="required">*</span>' : '')) ?>

    <?= $form->field($model, 'grade_level_id')->widget(Select2::classname(), [
        'data' => GradeLevel::getDropdownData(),
        'size' => Select2::SMALL,
        'options' => ['placeholder' => 'Select grade level ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label($model->getAttributeLabel('grade_level_id') . ($model->isAttributeRequired('grade_level_id') ? ' <span class="required">*</span>' : '')) ?>

    <?= $form->field($model, 'section_id')->widget(Select2::classname(), [
        'data' => Section::getDropdownData(),
        'size' => Select2::SMALL,
        'options' => ['placeholder' => 'Select user ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label($model->getAttributeLabel('section_id') . ($model->isAttributeRequired('section_id') ? ' <span class="required">*</span>' : '')) ?>

    <?= $form->field($model, 'strand_id')->widget(Select2::classname(), [
        'data' => Strand::getDropdownData(),
        'size' => Select2::SMALL,
        'options' => ['placeholder' => 'Select user ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label($model->getAttributeLabel('strand_id') . ($model->isAttributeRequired('strand_id') ? ' <span class="required">*</span>' : '')) ?>

    <div class="modal-footer" style="border-top: 0; margin: 0; padding: 0;">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-primary px-5 bg-maroon', 'style' => 'margin: 0; border: 0;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
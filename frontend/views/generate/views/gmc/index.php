<?php

use common\models\GradeLevel;
use common\models\SchoolYear;
use common\models\Section;
use common\models\Strand;
use common\models\StudentData;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\base\DynamicModel;

/** @var yii\web\View $this */
/** @var DynamicModel $model */ // Type hint the $model variable
/** @var ActiveForm $form */

$this->title = 'Generate Good Moral';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="good-moral-index px-4">
    <?php $form = ActiveForm::begin(['id' => 'form-good-moral', 'action' => ['gmc/generate'], 'method' => 'post']); ?>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-user"></i> Student Information
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">School Year</label>
                    <?= Select2::widget([
                        'name' => 'schoolYearDropdown',
                        'id' => 'schoolYearDropdown',
                        'data' => SchoolYear::getDropdownData(),
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
                    'initialize' => true,
                    'params' => ['studentDataId'],
                ],
            ])->label('Student Name') ?>
        </div>
    </div>

    <div class="form-good-moral text-right">
        <?= Html::submitButton('Generate', [
            'class' => 'btn btn-primary btn-block',
            'name' => 'signup-button'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
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

$form = ActiveForm::begin(['id' => 'student-data-form', 'enableAjaxValidation' => false,]);
?>

<div class="stepper-container">
    <div class="stepper-indicators">
        <span class="step-indicator active" data-step="1">1</span>
        <span class="step-indicator" data-step="2">2</span>
        <span class="step-indicator" data-step="3">3</span>
        <span class="step-indicator" data-step="4">4</span>
    </div>

    <div class="modal-body stepper-content" style="padding: 0px;">
        <div class="card mb-5 step" data-step="1">
            <div class="card-header"><i class="fas fa-user-tag"></i> Student's Class Details</div>
            <div class="card-body">
                <div class="form-row">
                    <?php // ... (your form fields) ... 
                    ?>
                </div>
            </div>
        </div>

        <div class="card mb-5 step" data-step="2" style="display: none;">
            <div class="card-header"><i class="fas fa-user"></i> Student's Personal Information</div>
            <div class="card-body">
                <div class="form-row">
                    <?php // ... (your form fields) ... 
                    ?>
                </div>
            </div>
        </div>

        <div class="card mb-5 step" data-step="3" style="display: none;">
            <div class="card-header"><i class="fas fa-user-group"></i> Guardian Information</div>
            <div class="card-body">
                <div class="form-row">
                    <?php // ... (your form fields) ... 
                    ?>
                </div>
            </div>
        </div>

        <div class="card mb-5 step" data-step="4" style="display: none;">
            <div class="card-header"><i class="fas fa-list-check"></i> Student Plan</div>
            <div class="card-body">
                <div class="form-row d-flex justify-content-around">
                    <?php // ... (your form fields) ... 
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer stepper-navigation" style="border-top: 0; margin: 0; padding: 0;">
        <button type="button" class="btn btn-secondary previous-step" style="display: none;">Previous</button>
        <button type="button" class="btn btn-primary next-step">Next</button>
        <?= Html::submitButton($studentDataModel->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-primary px-5 bg-maroon submit-step', 'style' => 'margin: 0; border: 0; display: none;']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<style>
    .stepper-container {
        position: relative;
    }

    .stepper-indicators {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .step-indicator {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 5px;
        cursor: pointer;
    }

    .step-indicator.active {
        background-color: #007bff;
        color: white;
    }

    .stepper-navigation {
        display: flex;
        justify-content: space-between;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentStep = 1;
        const steps = document.querySelectorAll('.step');
        const indicators = document.querySelectorAll('.step-indicator');
        const prevButton = document.querySelector('.previous-step');
        const nextButton = document.querySelector('.next-step');
        const submitButton = document.querySelector('.submit-step');

        function showStep(step) {
            steps.forEach(s => s.style.display = 'none');
            indicators.forEach(i => i.classList.remove('active'));

            const currentStepElement = document.querySelector(`.step[data-step="${step}"]`);
            const currentIndicator = document.querySelector(`.step-indicator[data-step="${step}"]`);

            if (currentStepElement) currentStepElement.style.display = 'block';
            if (currentIndicator) currentIndicator.classList.add('active');

            prevButton.style.display = step > 1 ? 'block' : 'none';
            nextButton.style.display = step < steps.length ? 'block' : 'none';
            submitButton.style.display = step === steps.length ? 'block' : 'none';
        }

        showStep(currentStep);

        nextButton.addEventListener('click', () => {
            if (currentStep < steps.length) {
                currentStep++;
                showStep(currentStep);
            }
        });

        prevButton.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });
</script>
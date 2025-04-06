<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Create New User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup" style="
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 50vh;
    padding-left: 2rem;
    padding-right: 2rem;
">

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

    <div class="card mb-3" style="width: 100%; max-width: 800px;">
        <div class="card-header" style="background-color: #E5E7EB;">
            <i class="fas fa-user"></i> Account Details
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'username')->textInput([
                        'autofocus' => true,
                        'class' => 'form-control form-control-sm'
                    ])->label($model->getAttributeLabel('username') . ($model->isAttributeRequired('username') ? ' <span class="required">*</span>' : '')) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'password')->passwordInput([
                        'class' => 'form-control form-control-sm'
                    ])->label($model->getAttributeLabel('password') . ($model->isAttributeRequired('password') ? ' <span class="required">*</span>' : '')) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'email')->textInput([
                        'class' => 'form-control form-control-sm',
                        'type' => 'email'
                    ])->label($model->getAttributeLabel('email') . ($model->isAttributeRequired('email') ? ' <span class="required">*</span>' : '')) ?>
                </div>
                <div class="col-md-6">
                    <?php
                    echo $form->field($model, 'role', ['options' => ['tag' => false]])
                        ->widget(Select2::class, [
                            // 'name' => 'role',
                            'data' => $roleOptions,
                            'size' => Select2::SMALL,
                            'options' => [
                                'placeholder' => 'Select Role...',
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ])->label($model->getAttributeLabel('role') . ($model->isAttributeRequired('role') ? ' <span class="required">*</span>' : ''))
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3" style="width: 100%; max-width: 800px;">
        <div class="card-header" style="background-color: #E5E7EB;">
            <i class="fas fa-info-circle"></i> Personal Information
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($personalInformationModel, 'first_name')->textInput([
                        'maxlength' => true,
                        'class' => 'form-control form-control-sm'
                    ])->label($personalInformationModel->getAttributeLabel('first_name') . ($personalInformationModel->isAttributeRequired('first_name') ? ' <span class="required">*</span>' : '')) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($personalInformationModel, 'middle_name')->textInput([
                        'maxlength' => true,
                        'class' => 'form-control form-control-sm'
                    ])->label($personalInformationModel->getAttributeLabel('middle_name') . ($personalInformationModel->isAttributeRequired('middle_name') ? ' <span class="required">*</span>' : '')) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($personalInformationModel, 'last_name')->textInput([
                        'maxlength' => true,
                        'class' => 'form-control form-control-sm'
                    ])->label($personalInformationModel->getAttributeLabel('last_name') . ($personalInformationModel->isAttributeRequired('last_name') ? ' <span class="required">*</span>' : '')) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($personalInformationModel, 'ext_name')->textInput([
                        'maxlength' => true,
                        'class' => 'form-control form-control-sm'
                    ])->label($personalInformationModel->getAttributeLabel('ext_name') . ($personalInformationModel->isAttributeRequired('ext_name') ? ' <span class="required">*</span>' : '')) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($personalInformationModel, 'birthdate')->input('date', [
                        'class' => 'form-control form-control-sm',
                    ])->label($personalInformationModel->getAttributeLabel('birthdate') . ($personalInformationModel->isAttributeRequired('birthdate') ? ' <span class="required">*</span>' : '')) ?>
                </div>
                <div class="col-md-9">
                    <?= $form->field($personalInformationModel, 'birthplace')->textInput([
                        'maxlength' => true,
                        'class' => 'form-control form-control-sm'
                    ])->label($personalInformationModel->getAttributeLabel('birthplace') . ($personalInformationModel->isAttributeRequired('birthplace') ? ' <span class="required">*</span>' : '')) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group text-right" style="width: 100%; max-width: 800px;">
        <?= Html::submitButton('Signup', [
            'class' => 'btn btn-primary btn-block',
            'name' => 'signup-button'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
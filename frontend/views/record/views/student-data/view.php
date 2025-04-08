<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap4\Modal;

echo $this->render('@frontend/views/_components/_modal');

$this->title = "Student Data: " . $model->personalInformation->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Student Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="student-data-view px-4">

    <div class="row d-flex justify-content-between">
        <p style="margin-left: 24px;">
            <?= Html::a('<i class="fas fa-arrow-left"></i> Go Back', '/record/student-data/index', ['class' => 'btn btn-secondary']) ?>
            <?= Html::a('Update', '#', [
                'class' => 'btn btn-primary',
                'id' => 'modalButton',
                'data-title' => 'Update Student Data: ' . $model->personalInformation->fullName,
                'data-subtitle' => 'Please fill up the details below.',
                'data-icon' => 'fas fa-user-graduate',
                'data-url' => Url::to(['/record/student-data/update', 'id' => $model->id]),
                'data-type' => 'POST',
                'data-width' => Modal::SIZE_EXTRA_LARGE,
                'data-toggle' => 'modal',
                'data-target' => '#svmsModal',
            ]) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <p style="margin-right: 24px;">
            <?= Html::a('Export Anecdotal', ['/record/student-data/export-anecdotal', 'studentId' => $model->id], [
                'class' => 'btn btn-success',
                // 'target' => '_blank',
            ]) ?>
        </p>

    </div>
    <div class="px-3">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'lrn',
                [
                    'attribute' => 'personal_information_id',
                    'label' => 'Student Name',
                    'value' => function ($model) {
                        return $model->personalInformation->fullName;
                    }
                ],
                [
                    'attribute' => 'personal_information_id',
                    'label' => 'Birth Date',
                    'value' => function ($model) {
                        if ($model->personalInformation && $model->personalInformation->birthdate) {
                            return Yii::$app->formatter->asDate($model->personalInformation->birthdate, 'MMMM d, yyyy');
                        }
                        return null;
                    }
                ],
                [
                    'attribute' => 'school_year_id',
                    'label' => 'School Year',
                    'value' => function ($model) {
                        return $model->schoolYear->name;
                    }
                ],
                [
                    'attribute' => 'adviser_id',
                    'label' => 'Adviser',
                    'value' => function ($model) {
                        return $model->adviser->personalInformation->fullName;
                    }
                ],
                [
                    'attribute' => 'grade_level_id',
                    'label' => 'Grade, Strand, Section',
                    'value' => function ($model) {
                        return $model->studentClass;
                    }
                ],
                [
                    'label' => 'Language',
                    'value' => function ($model) {
                        return $model->studentInformation->language ?? '-';
                    }
                ],
                [
                    'attribute' => 'guardian_id',
                    'label' => 'Guardian Name',
                    'value' => function ($model) {
                        return $model->guardian->personalInformation->fullName;
                    }
                ],
                [
                    'attribute' => 'guardian_id',
                    'label' => 'Guardian Contact No.',
                    'value' => function ($model) {
                        return $model->guardian->contact_number ?? '-';
                    }
                ],
                [
                    'label' => 'Pantawid Pamilyang Pilipino Program (4Ps)',
                    'value' => function ($model) {
                        return $model->studentInformation->four_p_status ? "Member" : "Not a member";
                    }
                ],
                [
                    'label' => 'Early Disease/s',
                    'value' => function ($model) {
                        return $model->studentInformation->early_disease ?? "-";
                    }
                ],
                [
                    'label' => 'Serious Accident/s',
                    'value' => function ($model) {
                        return $model->studentInformation->serious_accident ?? "-";
                    }
                ],
                [
                    'label' => 'Hobby',
                    'value' => function ($model) {
                        return $model->studentInformation->hobby ?? '-';
                    }
                ],
                [
                    'label' => 'Special Talent',
                    'value' => function ($model) {
                        return $model->studentInformation->special_talent ?? '-';
                    }
                ],
                [
                    'label' => 'Easy Subject',
                    'value' => function ($model) {
                        return $model->studentInformation->easy_subject ?? '-';
                    }
                ],
                [
                    'label' => 'Hard Subject',
                    'value' => function ($model) {
                        return $model->studentInformation->hard_subject ?? '-';
                    }
                ],
                [
                    'attribute' => 'created_at',
                    'value' => function ($model) {
                        return date('F d, Y | h:i:s A', $model->created_at);
                    }
                ],
                [
                    'attribute' => 'updated_at',
                    'value' => function ($model) {
                        return date('F d, Y | h:i:s A', $model->updated_at);
                    }
                ],
            ],
        ]) ?>
    </div>

</div>
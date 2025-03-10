<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->personalInformation->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Student Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-data-view">

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Go Back', '/record/student-data/index', ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'personal_information_id',
                'label' => 'Student Name',
                'value' => function ($model) {
                    return $model->personalInformation->fullName;
                }
            ],
            [
                'attribute' => 'grade_level_id',
                'label' => 'Student Grade, Strand, Section',
                'value' => function ($model) {
                    return $model->studentClass;
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
                    return $model->guardian->contact_number;
                }
            ],
            'student_information_id',
            'guardian_id',
            'student_plan_id',
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
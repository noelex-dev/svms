<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap4\Modal;

echo $this->render('@frontend/views/_components/_modal');

$this->title = $model->user->personalInformation->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Teacher Advisory Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="teacher-advisory-assignment-view px-4">

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Go Back', '/record/teacher-advisory-assignment/index', ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Update', '#', [
            'class' => 'btn btn-primary',
            'id' => 'modalButton',
            'data-title' => "Teacher's Advisory",
            'data-subtitle' => 'Please fill up the details below.',
            'data-icon' => 'fas fa-calendar-check',
            'data-url' => Url::to(['/record/teacher-advisory-assignment/update', 'id' => $model->id]),
            'data-type' => 'POST',
            'data-width' => Modal::SIZE_LARGE,
            'data-toggle' => 'modal',
            'data-target' => '#svmsModal',
        ]); ?>
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
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->user->personalInformation->fullName . ' (' . $model->user->username . ')';
                }
            ],
            [
                'attribute' => 'grade_level_id',
                'value' => function ($model) {
                    return $model->gradeLevel->name;
                }
            ],
            [
                'attribute' => 'section_id',
                'value' => function ($model) {
                    return $model->section->name;
                }
            ],
            [
                'attribute' => 'strand_id',
                'value' => function ($model) {
                    return $model->strand->name;
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
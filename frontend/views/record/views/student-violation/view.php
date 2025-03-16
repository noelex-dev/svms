<?php

use common\models\StudentData;
use common\models\Violation;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap4\Modal;

echo $this->render('@frontend/views/_components/_modal');


$this->title = 'Update Student Violation ';
$this->params['breadcrumbs'][] = ['label' => 'Student Violations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-violation-view">

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Go Back', '/record/student-data/index', ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Update', '#', [
            'class' => 'btn btn-primary',
            'id' => 'modalButton',
            'data-title' => 'Update Student Violation: ' . $model->studentData->personalInformation->fullName,
            'data-subtitle' => 'Please fill up the details below.',
            'data-icon' => 'fas fa-user-graduate',
            'data-url' => Url::to(['/record/student-violation/update', 'id' => $model->id]),
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'student_data_id',
                'value' => function ($model) {
                    $studentModel = StudentData::findOne($model->student_data_id);
                    return $studentModel ? $studentModel->personalInformation->fullName : 'N/A';
                }
            ],
            [
                'attribute' => 'violation_id',
                'value' => function ($model) {
                    $violationModel = Violation::findOne($model->violation_id);
                    return $violationModel ? $violationModel->name : 'N/A';
                }
            ],
            [
                'label' => 'Violation Type',
                'attribute' => 'violation_id',
                'value' => function ($model) {
                    $violationModel = Violation::findOne($model->violation_id);
                    return $violationModel ? $violationModel->violationType->name : 'N/A';
                }
            ],
            [
                'attribute' => 'notification_status',
                'value' => function ($model) {
                    return $model->notification_status ? 'Notified' : 'Not Notified';
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
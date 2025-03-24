<?php

use common\models\StudentData;
use common\models\StudentViolation;
use common\models\Violation;
use common\models\ViolationType;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\Modal;

echo $this->render('@frontend/views/_components/_modal');

$this->title = 'Student Violations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-violation-index">

    <p>
        <?= Html::a('Add', '#', [
            'class' => 'btn btn-primary bg-maroon px-5',
            'id' => 'modalButton',
            'data-title' => 'Add Student Violation',
            'data-subtitle' => 'Please fill up the details below.',
            'data-icon' => 'fas fa-user-times',
            'data-url' => Url::to(['/record/student-violation/create']),
            'data-type' => 'POST',
            'data-width' => Modal::SIZE_EXTRA_LARGE,
            'data-toggle' => 'modal',
            'data-target' => '#svmsModal',
        ]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'options' => ['class' => 'pagination justify-content-center'],
            'linkContainerOptions' => ['class' => 'page-item'],
            'linkOptions' => ['class' => 'page-link'],
            'disabledListItemSubTagOptions' => ['class' => 'page-link'],
            'prevPageLabel' => 'Previous',
            'nextPageLabel' => 'Next',
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'width: 5%; text-align: center;'],
                'contentOptions' => ['style' => 'width: 5%; text-align: center; vertical-align: middle;'],
            ],

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
                'attribute' => 'is_settled',
                'value' => function ($model) {
                    if ($model->is_settled === 1) {
                        return '<span class="text-md m-0 py-1" 
                                    style="background-color: #05DF72; color: #0D542B; border-radius: 9px; width: 90px; display: inline-block; text-align: center;">
                                    <strong>Settled</strong>
                                </span>';
                    } else {
                        return '<span class="text-md m-0 py-1" 
                                    style="background-color: #FFA2A2; color: #9F0712; border-radius: 9px; width: 90px; display: inline-block; text-align: center;">
                                    <strong>Unsettled</strong>
                                </span>';
                    }
                },
                'format' => 'raw',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, StudentViolation $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'view' => function ($url, StudentViolation $model, $key) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'class' => 'btn btn-sm btn-info',
                        ]);
                    },
                    'update' => function ($url, StudentViolation $model, $key) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', '#', [
                            'class' => 'btn btn-sm btn-primary',
                            'id' => 'modalButton',
                            'data-title' => 'Update Student Violation: ',
                            'data-subtitle' => 'Please fill up the details below.',
                            'data-icon' => 'fas fa-exclamation-circle',
                            'data-url' => Url::to(['/record/student-violation/update', 'id' => $model->id]),
                            'data-type' => 'POST',
                            'data-width' => Modal::SIZE_EXTRA_LARGE,
                            'data-toggle' => 'modal',
                            'data-target' => '#svmsModal',
                        ]);
                    },
                    'delete' => function ($url, StudentViolation $model, $key) {
                        return Html::a('<i class="fas fa-trash"></i>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'class' => 'btn btn-sm btn-danger',
                            'data' => [
                                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
                'headerOptions' => ['style' => 'width: 10%; text-align: center;'],
                'contentOptions' => ['style' => 'width: 10%; text-align: center; vertical-align: middle;'],
                'template' => '{view} {update} {delete}',
            ]
        ],
    ]); ?>


</div>
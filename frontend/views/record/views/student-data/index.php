<?php

use common\models\StudentData;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\Modal;

echo $this->render('@frontend/views/_components/_modal');

$this->title = 'Student List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-data-index px-4">

    <p>
        <?= Html::a('Add', '/record/student-data/create', [
            'class' => 'btn btn-primary bg-maroon px-5',
            'id' => 'modalButton',
            'data-title' => 'Add Student Data',
            'data-subtitle' => 'Please fill up the details below.',
            'data-icon' => 'fas fa-user-graduate',
            'data-url' => Url::to(['/record/student-data/create']),
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
                'attribute' => 'studentName',
                'label' => 'Student Name',
                'value' => function ($model) {
                    return $model->personalInformation->fullName;
                },
            ],
            [
                'attribute' => 'guardianName',
                'label' => 'Guardian Name',
                'value' => function ($model) {
                    return $model->guardian->personalInformation->fullName;
                },
            ],
            [
                'attribute' => 'gradeLevelName',
                'label' => 'Grade Level',
                'value' => function ($model) {
                    return $model->gradeLevel->name;
                }
            ],
            [
                'attribute' => 'sectionName',
                'label' => 'Section',
                'value' => function ($model) {
                    return $model->section->name;
                }
            ],
            [
                'attribute' => 'strandName',
                'label' => 'Strand',
                'value' => function ($model) {
                    return $model->strand->name;
                }
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, StudentData $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'view' => function ($url, StudentData $model, $key) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'class' => 'btn btn-sm btn-info',
                        ]);
                    },
                    'update' => function ($url, StudentData $model, $key) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', '#', [
                            'class' => 'btn btn-sm btn-primary',
                            'id' => 'modalButton',
                            'data-title' => 'Update Student Data: ' . $model->personalInformation->fullName,
                            'data-subtitle' => 'Please fill up the details below.',
                            'data-icon' => 'fas fa-user-graduate',
                            'data-url' => Url::to(['/record/student-data/update', 'id' => $model->id]),
                            'data-type' => 'POST',
                            'data-width' => Modal::SIZE_EXTRA_LARGE,
                            'data-toggle' => 'modal',
                            'data-target' => '#svmsModal',
                        ]);
                    },
                    'delete' => function ($url, StudentData $model, $key) {
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
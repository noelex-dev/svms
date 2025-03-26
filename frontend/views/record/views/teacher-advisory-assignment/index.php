<?php

use common\models\StudentViolation;
use common\models\TeacherAdvisoryAssignment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\Modal;

echo $this->render('@frontend/views/_components/_modal');

$this->title = 'Teacher Advisory Assignment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-advisory-assignment-index px-4">

    <p>
        <?= Html::a('Assign', ['create'], ['class' => 'btn btn-success px-5 bg-maroon']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'width: 10%; text-align: center;'],
                'contentOptions' => ['style' => 'width: 10%; text-align: center; vertical-align: middle;'],
            ],

            [
                'attribute' => 'user_id',
                'label' => 'Teacher Name',
                // 'value' => function ($model) {
                //     // return $model->personalInformation->fullName;
                // }
            ],
            [
                'attribute' => 'grade_level_id',
                'label' => 'Grade Level',
                'value' => function ($model) {
                    return $model->gradeLevel->name;
                }
            ],
            [
                'attribute' => 'section_id',
                'label' => 'Section',
                'value' => function ($model) {
                    return $model->section->name;
                }
            ],
            [
                'attribute' => 'strand_id',
                'label' => 'Strand',
                'value' => function ($model) {
                    return $model->strand->name;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TeacherAdvisoryAssignment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'view' => function ($url, TeacherAdvisoryAssignment $model, $key) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'class' => 'btn btn-sm btn-info',
                        ]);
                    },
                    'update' => function ($url, TeacherAdvisoryAssignment $model, $key) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', '#', [
                            'class' => 'btn btn-sm btn-primary',
                            'id' => 'modalButton',
                            'data-title' => 'Update Teacher Advisory: ',
                            'data-subtitle' => 'Please fill up the details below.',
                            'data-icon' => 'fas fa-chalkboard-teacher',
                            'data-url' => Url::to(['/record/teacher-advisory-assignment/update', 'id' => $model->id]),
                            'data-type' => 'POST',
                            'data-width' => Modal::SIZE_LARGE,
                            'data-toggle' => 'modal',
                            'data-target' => '#svmsModal',
                        ]);
                    },
                    'delete' => function ($url, TeacherAdvisoryAssignment $model, $key) {
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
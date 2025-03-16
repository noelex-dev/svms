<?php

use common\models\ActiveSchoolYearSem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\Modal;

echo $this->render('@frontend/views/_components/_modal');

$this->title = 'School Year & Semesters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="active-school-year-sem-index">

    <p>
        <?= Html::a('Add', '#', [
            'class' => 'btn btn-primary bg-maroon px-5',
            'id' => 'modalButton',
            'data-title' => 'Activate School Year - Semester',
            'data-subtitle' => 'Please fill up the details below.',
            'data-icon' => 'fas fa-calendar-check',
            'data-url' => Url::to(['/cms/active-school-year-sem/create']),
            'data-type' => 'POST',
            'data-width' => Modal::SIZE_LARGE,
            'data-toggle' => 'modal',
            'data-target' => '#svmsModal',
        ]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'pager' => [
            'options' => ['class' => 'pagination justify-content-center'],
            'linkContainerOptions' => ['class' => 'page-item'],
            'linkOptions' => ['class' => 'page-link'],
            'disabledListItemSubTagOptions' => ['class' => 'page-link'],
            'prevPageLabel' => 'Previous',
            'nextPageLabel' => 'Next',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'school_year_id',
                'value' => function ($model) {
                    return $model->schoolYear->name;
                }
            ],
            [
                'attribute' => 'semester_id',
                'value' => function ($model) {
                    return $model->semester->name;
                }
            ],
            [
                'attribute' => 'is_active',
                'value' => function ($model) {
                    if ($model->is_active === 1) {
                        return '<span class="text-md m-0 py-1" style="background-color: #05DF72; color: #0D542B; border-radius: 9px; width: 90px; display: inline-block; text-align: center;"><strong>Active</strong></span>';
                    } else {
                        return '<span class="text-md m-0 py-1" style="background-color: #FFA2A2; color: #9F0712; border-radius: 9px; width: 90px; display: inline-block; text-align: center;"><strong>Inactive</strong></span>';
                    }
                },
                'format' => 'raw',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ActiveSchoolYearSem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'view' => function ($url, ActiveSchoolYearSem $model, $key) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'class' => 'btn btn-sm btn-info',
                        ]);
                    },
                    'update' => function ($url, ActiveSchoolYearSem $model, $key) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', '#', [
                            'class' => 'btn btn-sm  btn-primary',
                            'id' => 'modalButton',
                            'data-title' => 'Update School Year: ' . $model->schoolYear->name . ' | ' . $model->semester->name,
                            'data-subtitle' => 'Please fill up the details below.',
                            'data-icon' => 'fas fa-calendar-check',
                            'data-url' => Url::to(['/cms/active-school-year-sem/update', 'id' => $model->id]),
                            'data-type' => 'POST',
                            'data-width' => Modal::SIZE_LARGE,
                            'data-toggle' => 'modal',
                            'data-target' => '#svmsModal',
                        ]);
                    },
                    'delete' => function ($url, ActiveSchoolYearSem $model, $key) {
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
                'template' => '{view} {update} {delete}',
            ]
        ],
    ]); ?>


</div>
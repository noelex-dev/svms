<?php

use common\models\SchoolYear;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\Modal;

echo $this->render('@frontend/views/_components/_modal');

$this->title = 'School Years';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-year-index">

    <p>
        <?= Html::a('Add', '#', [
            'class' => 'btn btn-primary bg-maroon px-5',
            'id' => 'modalButton',
            'data-title' => 'Add School Year',
            'data-subtitle' => 'Please fill up the details below.',
            'data-icon' => 'fas fa-calendar-alt',
            'data-url' => Url::to(['/cms/school-year/create']),
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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'year_start',
            'year_end',
            [
                'attribute' => 'semester_id',
                'value' => function ($model) {
                    return $model->semester->name;
                }
            ],
            'name',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SchoolYear $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'view' => function ($url, SchoolYear $model, $key) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'class' => 'btn btn-sm btn-info',
                        ]);
                    },
                    'update' => function ($url, SchoolYear $model, $key) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', '#', [
                            'class' => 'btn btn-sm btn-primary',
                            'id' => 'modalButton',
                            'data-title' => 'Update School Year: ' . $model->name,
                            'data-subtitle' => 'Please fill up the details below.',
                            'data-icon' => 'fas fa-calendar-alt',
                            'data-url' => Url::to(['/cms/school-year/update', 'id' => $model->id]),
                            'data-type' => 'POST',
                            'data-width' => Modal::SIZE_LARGE,
                            'data-toggle' => 'modal',
                            'data-target' => '#svmsModal',
                        ]);
                    },
                    'delete' => function ($url, SchoolYear $model, $key) {
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
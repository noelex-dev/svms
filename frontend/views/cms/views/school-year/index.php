<?php

use common\models\SchoolYear;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = 'School Years';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-year-index">

    <p>
        <?= Html::a('Add', ['create'], ['class' => 'btn btn-success px-5 bg-maroon']) ?>
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
                        return Html::a('<i class="fas fa-pencil-alt"></i>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'class' => 'btn btn-sm btn-primary',
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
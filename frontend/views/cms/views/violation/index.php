<?php

use common\models\Violation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = 'Violations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="violation-index">

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

            'name',
            [
                'attribute' => 'violation_type_id',
                'value' => function ($model) {
                    return $model->violationType->name;
                }
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Violation $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'view' => function ($url, Violation $model, $key) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'class' => 'btn btn-sm btn-info',
                        ]);
                    },
                    'update' => function ($url, Violation $model, $key) {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'class' => 'btn btn-sm btn-primary',
                        ]);
                    },
                    'delete' => function ($url, Violation $model, $key) {
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
<?php

use common\models\StudentInformation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = 'Student Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-information-index">

    <p>
        <?= Html::a('Create Student Information', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'language',
            'height',
            'weight',
            'early_disease:ntext',
            //'serious_accident:ntext',
            //'hobby',
            //'special_talent',
            //'easy_subject',
            //'hard_subject',
            //'4ps_status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, StudentInformation $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
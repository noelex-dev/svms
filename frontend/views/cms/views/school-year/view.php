<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap4\Modal;

echo $this->render('@frontend/views/_components/_modal');

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'School Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="school-year-view">

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Go Back', '/cms/school-year/index', ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Update', '#', [
            'class' => 'btn btn-primary',
            'id' => 'modalButton',
            'data-title' => 'Update School Year: ' . $model->name,
            'data-subtitle' => 'Please fill up the details below.',
            'data-icon' => 'fas fa-calendar-alt',
            'data-url' => Url::to(['/cms/school-year/update', 'id' => $model->id]),
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
                'attribute' => 'year_start',
                'value' => function ($model) {
                    return date('F j, Y', strtotime($model->year_start));
                }
            ],
            [
                'attribute' => 'year_start',
                'value' => function ($model) {
                    return date('F j, Y', strtotime($model->year_end));
                }
            ],
            [
                'attribute' => 'semester_id',
                'value' => function ($model) {
                    return $model->semester->name;
                }
            ],
            'name',
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
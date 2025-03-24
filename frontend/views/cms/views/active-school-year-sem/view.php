<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap4\Modal;

echo $this->render('@frontend/views/_components/_modal');

$this->title = $model->schoolYear->name . ' | ' . $model->semester->name;
$this->params['breadcrumbs'][] = ['label' => 'Active School Year Sems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="active-school-year-sem-view px-4">

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Go Back', '/cms/active-school-year-sem/index', ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Update', '#', [
            'class' => 'btn btn-primary',
            'id' => 'modalButton',
            'data-title' => 'Update School Year: ' . $model->schoolYear->name . ' | ' . $model->semester->name,
            'data-subtitle' => 'Please fill up the details below.',
            'data-icon' => 'fas fa-calendar-check',
            'data-url' => Url::to(['/cms/active-school-year-sem/update', 'id' => $model->id]),
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
                    return $model->is_active ? 'Active' : 'Inactive';
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
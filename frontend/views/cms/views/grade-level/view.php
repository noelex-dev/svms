<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap4\Modal;

echo $this->render('@frontend/views/_components/_modal');

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Grade Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="grade-level-view px-4">

    <p>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Go Back', '/cms/grade-level/index', ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Update', '#', [
            'class' => 'btn btn-primary',
            'id' => 'modalButton',
            'data-title' => 'Update Grade Level: ' . $model->name,
            'data-subtitle' => 'Please fill up the details below.',
            'data-icon' => 'fas fa-layer-group',
            'data-url' => Url::to(['/cms/grade-level/update', 'id' => $model->id]),
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
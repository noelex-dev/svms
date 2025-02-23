<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\StudentInformation $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-information-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'language',
            'height',
            'weight',
            'early_disease:ntext',
            'serious_accident:ntext',
            'hobby',
            'special_talent',
            'easy_subject',
            'hard_subject',
            '4ps_status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;

$this->title = 'Update Grade Level: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Grade Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grade-level-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
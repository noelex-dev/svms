<?php

use yii\helpers\Html;


$this->title = 'Update Teacher Advisory Assignment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teacher Advisory Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teacher-advisory-assignment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
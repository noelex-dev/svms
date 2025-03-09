<?php

use yii\helpers\Html;


$this->title = 'Create Teacher Advisory Assignment';
$this->params['breadcrumbs'][] = ['label' => 'Teacher Advisory Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-advisory-assignment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
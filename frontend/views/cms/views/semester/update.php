<?php

use yii\helpers\Html;

$this->title = 'Update Semester: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Semesters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="semester-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
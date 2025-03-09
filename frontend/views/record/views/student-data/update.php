<?php

use yii\helpers\Html;


$this->title = 'Update Student Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-data-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php

use yii\helpers\Html;

$this->title = 'Update Student Information: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-information-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
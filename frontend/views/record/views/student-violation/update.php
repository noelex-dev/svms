<?php

use yii\helpers\Html;


$this->title = 'Update Student Violation: ' . $model->studentData->personalInformation->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Student Violations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-violation-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
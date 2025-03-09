<?php

use yii\helpers\Html;

$this->title = 'Update Student Guardian: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Guardians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-guardian-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php

use yii\helpers\Html;

$this->title = 'Create Student Data';
$this->params['breadcrumbs'][] = ['label' => 'Student Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-data-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
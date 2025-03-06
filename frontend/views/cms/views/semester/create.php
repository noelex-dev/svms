<?php

use yii\helpers\Html;


$this->title = 'Add Semester';
$this->params['breadcrumbs'][] = ['label' => 'Semesters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semester-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
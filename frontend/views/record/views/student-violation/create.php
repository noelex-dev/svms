<?php

use yii\helpers\Html;


$this->title = 'Create Student Violation';
$this->params['breadcrumbs'][] = ['label' => 'Student Violations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-violation-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
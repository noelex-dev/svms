<?php

use yii\helpers\Html;


$this->title = 'Create Student Information';
$this->params['breadcrumbs'][] = ['label' => 'Student Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-information-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
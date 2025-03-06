<?php

use yii\helpers\Html;


$this->title = 'Create Student Plan';
$this->params['breadcrumbs'][] = ['label' => 'Student Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-plan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
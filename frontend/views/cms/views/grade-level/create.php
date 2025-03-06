<?php

use yii\helpers\Html;


$this->title = 'Add Grade Level';
$this->params['breadcrumbs'][] = ['label' => 'Grade Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-level-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
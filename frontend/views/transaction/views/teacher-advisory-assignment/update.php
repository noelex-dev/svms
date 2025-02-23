<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TeacherAdvisoryAssignment $model */

$this->title = 'Update Teacher Advisory Assignment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teacher Advisory Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teacher-advisory-assignment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

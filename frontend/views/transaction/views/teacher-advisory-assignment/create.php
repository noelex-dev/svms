<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TeacherAdvisoryAssignment $model */

$this->title = 'Create Teacher Advisory Assignment';
$this->params['breadcrumbs'][] = ['label' => 'Teacher Advisory Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-advisory-assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

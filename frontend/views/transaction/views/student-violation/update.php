<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\StudentViolation $model */

$this->title = 'Update Student Violation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Violations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-violation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

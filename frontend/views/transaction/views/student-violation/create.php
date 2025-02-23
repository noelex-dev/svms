<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\StudentViolation $model */

$this->title = 'Create Student Violation';
$this->params['breadcrumbs'][] = ['label' => 'Student Violations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-violation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

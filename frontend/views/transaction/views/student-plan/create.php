<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\StudentPlan $model */

$this->title = 'Create Student Plan';
$this->params['breadcrumbs'][] = ['label' => 'Student Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

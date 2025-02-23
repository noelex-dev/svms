<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\StudentData $model */

$this->title = 'Update Student Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

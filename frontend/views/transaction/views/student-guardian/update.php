<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\StudentGuardian $model */

$this->title = 'Update Student Guardian: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Guardians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-guardian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

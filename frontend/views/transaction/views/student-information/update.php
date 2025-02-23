<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\StudentInformation $model */

$this->title = 'Update Student Information: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-information-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

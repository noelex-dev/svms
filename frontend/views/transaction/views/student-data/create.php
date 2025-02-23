<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\StudentData $model */

$this->title = 'Create Student Data';
$this->params['breadcrumbs'][] = ['label' => 'Student Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

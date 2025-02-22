<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\GradeLevel $model */

$this->title = 'Create Grade Level';
$this->params['breadcrumbs'][] = ['label' => 'Grade Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

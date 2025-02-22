<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Semester $model */

$this->title = 'Create Semester';
$this->params['breadcrumbs'][] = ['label' => 'Semesters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semester-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

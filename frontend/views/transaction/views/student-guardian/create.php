<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\StudentGuardian $model */

$this->title = 'Create Student Guardian';
$this->params['breadcrumbs'][] = ['label' => 'Student Guardians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-guardian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

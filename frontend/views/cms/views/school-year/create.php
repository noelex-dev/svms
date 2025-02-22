<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SchoolYear $model */

$this->title = 'Create School Year';
$this->params['breadcrumbs'][] = ['label' => 'School Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-year-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

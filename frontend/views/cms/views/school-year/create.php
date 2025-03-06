<?php

use yii\helpers\Html;

$this->title = 'Add School Year';
$this->params['breadcrumbs'][] = ['label' => 'School Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-year-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
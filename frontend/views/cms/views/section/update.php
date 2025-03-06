<?php

use yii\helpers\Html;


$this->title = 'Update Section: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="section-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
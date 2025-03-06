<?php

use yii\helpers\Html;

$this->title = 'Update Violation Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Violation Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="violation-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
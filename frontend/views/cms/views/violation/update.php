<?php

use yii\helpers\Html;


$this->title = 'Update Violation: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Violations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="violation-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
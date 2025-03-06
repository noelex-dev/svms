<?php

use yii\helpers\Html;

$this->title = 'Update School Year: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'School Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="school-year-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
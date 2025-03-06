<?php

use yii\helpers\Html;


$this->title = 'Update Personal Information: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Personal Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="personal-information-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
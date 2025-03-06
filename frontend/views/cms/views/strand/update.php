<?php

use yii\helpers\Html;


$this->title = 'Update Strand: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Strands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="strand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
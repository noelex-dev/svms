<?php

use yii\helpers\Html;

$this->title = 'Add Relationship';
$this->params['breadcrumbs'][] = ['label' => 'Relationships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relationship-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
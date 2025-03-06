<?php

use yii\helpers\Html;


$this->title = 'Add Violation Type';
$this->params['breadcrumbs'][] = ['label' => 'Violation Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="violation-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>